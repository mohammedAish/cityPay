# Transfer

Transfer in our system are two well-known [Deposit](deposit) and [Withdraw](withdraw) 
operations that are performed in one transaction.

The transfer takes place between wallets.

---

## User Model

[User Simple](_include/models/user_simple.md ':include')

## Make a Transfer

Find user:

```php
$first = User::first(); 
$last = User::orderBy('id', 'desc')->first(); // last user
$first->getKey() !== $last->getKey(); // true
```

As the user uses `HasWallet`, he will have `balance` property. 
Check the user's balance.

```php
$first->balance; // int(100)
$last->balance; // int(0)
```

The transfer will be from the first user to the second.

```php
$first->transfer($last, 5); 
$first->balance; // int(95)
$last->balance; // int(5)
```

It worked! 

## Force Transfer

Check the user's balance.

```php
$first->balance; // int(100)
$last->balance; // int(0)
```

The transfer will be from the first user to the second.

```php
$first->forceTransfer($last, 500); 
$first->balance; // int(-400)
$last->balance; // int(500)
```

It worked! 
