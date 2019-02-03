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
$maybeValue = MaybeString::fromArrayAndStringKey($array, 'key');
    
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