# Maybe Values

`Maybe Values` are like nullable values, but with an additional associated
field which indicates whether the key associated with the value was set
in an array or object. This enables you to distinguish "present" from "null", which 
can be helpful for example when saving a nullable field to a database. 
 
Each `MaybeValue` has an associated type and a separate class (`MaybeString`, `MaybeInt`, etc).
You can also use `MaybeMixed` for any sort of value, or `MaybeObject` for an object. 

There is also a `MaybeValue` interface which all the `Maybe*` classes implement, so you
can write code for anything which implements that interface, or as well create your
own classes supporting that interface. If you do implement your own class, you can save time
by using the `MaybeTrait`, which implements most of the functionality of the interface already.
 
An example:

```php
use Best\Maybe\MaybeString;
$array = [
    'key' => 'string'
];
$maybeValue = MaybeString::fromArrayAndKey($array, 'key');
    
```


```php
class DB {
    private $pdo;
    
    public function saveValues(int $id, MaybeString $nullableField) {
        if ($nullableField->isMissing()) {
            return;
        }
        // save the field to the db, even if it's null:
        $this->db->saveField($id, $nullableField->getValueOrNull());
    }
} 
```

## Classes Summary

* `MaybeArray` - an `array`
* `MaybeBool` - a `bool`
* `MaybeCallable` - any `callable`
* `MaybeFloat` - a `float`
* `MaybeInt` - an `int`
* `MaybeIterable` - any `iterable` 
* `MaybeMixed` - any `mixed` value
* `MaybeObject` - any `object` (e.g. `\stdClass`)
* `MaybeResource` - a `resource`
* `MaybeString` - a `string`
* `MaybeValue` - an interface all the `Maybe*` classes implement

## Method Summary

### Factory Methods

These methods create the `MaybeValue` subclasses

#### public static function fromArrayAndKey(array $array, $key)

Create a new `MaybeValue` from an array and a value at key.

#### public static function fromArrayAccessibleAndKey(\ArrayAccess $arrayObject, $key)

Create a new `MaybeValue` from an object implementing `\ArrayAccess` and a value at key.

#### public static function fromObjectAndProperty(object $object, string $property)

Create a new `MaybeValue` from an array and return it.

### Filtered Factory Methods

Additionally, there are some methods that will use the `filter_var`
function to convert values from a `string` to another type. 

#### public static function fromArrayAndKeyFiltered(array $array, $key)
#### public static function fromArrayAccessibleAndKeyFiltered(\ArrayAccess $arrayObject, $key)
#### public static function fromObjectAndPropertyFiltered(object $object, string $property)

Similar to the non-filtered methods, except the value is passed through `filter_var`
appropriate to the type (for example, `filter_var($value, FILTER_VALIDATE_INT)` is used
for `MaybeInt`).


### Other Methods

#### isPresent(): bool

Whether the value is present.

*NOTE* this can still be true if the value is `null`.

#### isMissing(): bool

Whether the value is not present, so this is the inverse of `isPresent()`

#### getValue(): T

Return the value the `Maybe*` class represents

#### getValueOrNull(): ?T

Return the value the `Maybe*` class represents, or null if it was not present or was null.

#### isPresentAndNotNull(): bool

Whether the value is present and not null.

#### isMissingOrNull(): bool

Whether the value is missing or null.



