## Run this command to setup the repository
```
> composer install
```

## Under public folder create txt file (with the ff. format)
```
{"bin":"45717360","amount":"100.00","currency":"EUR"}
{"bin":"516793","amount":"50.00","currency":"USD"}
{"bin":"45417360","amount":"10000.00","currency":"JPY"}
{"bin":"41417360","amount":"130.00","currency":"USD"}
{"bin":"4745030","amount":"2000.00","currency":"GBP"}
```

## Run this command to calculate commission per transaction
```
> php app.php transactions.txt
```
Note: Second parameter would be the file name where the transactions are located.

## Run this command to test executions
```
> composer run test
```


