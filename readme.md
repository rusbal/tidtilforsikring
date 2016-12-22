# TTF ASSIGNMENT

###Base
```$xslt
A && B && !C => X = S

A && B && C => X = R

!A && B && C => X = T

[other] => [error]

X = S => Y = D + (D * E / 100)

X = R => Y = D + (D * (E - F) / 100)

X = T => Y = D - (D * F / 100)
```

###Specialized 1
```$xslt
X = R => Y = 2D + (D * E / 100)
```

###Specialized 2
```$xslt
A && B && !C => X = T
Here, I computed Y using the same formula as above when X = T.

A && !B && C => X = S

X = S => Y = F + D + (D * E / 100)
```

This solution is based on Laravel.

1. [tests/AlgorithmTest.php](https://github.com/rusbal/tidtilforsikring/blob/master/tests/AlgorithmTest.php "AlgorithmTest.php")
2. [app/Http/Controllers/InsuranceController.php](https://github.com/rusbal/tidtilforsikring/blob/master/app/Http/Controllers/InsuranceController.php "InsuranceController.php")
3. [app/Ttf/Algorithm.php](https://github.com/rusbal/tidtilforsikring/blob/master/app/Ttf/Algorithm.php "Algorithm.php")

To test, run phpunit.
```$xslt
$ phpunit
```
![Alt](https://github.com/rusbal/tidtilforsikring/blob/master/Screen%20Shot%202016-12-21%20at%2012.16.03%20AM.png?raw=true "Test result")

#v.2.0
###Refactored following SOLID Principles

1. [AlgorithmTest.php (Same as v1.0)](https://github.com/rusbal/tidtilforsikring/blob/master/tests/AlgorithmTest.php "tests/AlgorithmTest.php")
2. [InsuranceController.php (Same as v1.0)](https://github.com/rusbal/tidtilforsikring/blob/master/app/Http/Controllers/InsuranceController.php "app/Http/Controllers/InsuranceController.php")
3. [Caller class: Algorithm.php](https://github.com/rusbal/tidtilforsikring/blob/master/app/Ttf/Algorithm.php "app/Ttf/Algorithm.php")
4. [Abstract class: AlgorithmBase.php](https://github.com/rusbal/tidtilforsikring/blob/master/app/Ttf/AlgorithmBase.php "app/Ttf/AlgorithmBase.php")
5. [Implementation: AlgorithmBaseMappingR.php](https://github.com/rusbal/tidtilforsikring/blob/master/app/Ttf/AlgorithmBaseMappingR.php "app/Ttf/AlgorithmBaseMappingR.php")
6. [Implementation: AlgorithmBaseMappingS.php](https://github.com/rusbal/tidtilforsikring/blob/master/app/Ttf/AlgorithmBaseMappingS.php "app/Ttf/AlgorithmBaseMappingS.php")
7. [Implementation: AlgorithmBaseMappingT.php](https://github.com/rusbal/tidtilforsikring/blob/master/app/Ttf/AlgorithmBaseMappingT.php "app/Ttf/AlgorithmBaseMappingT.php")
8. [Implementation: AlgorithmSpecializedMappingR.php](https://github.com/rusbal/tidtilforsikring/blob/master/app/Ttf/AlgorithmSpecializedMappingR.php "app/Ttf/AlgorithmSpecializedMappingR.php")
9. [Implementation: AlgorithmSpecializedMappingS.php](https://github.com/rusbal/tidtilforsikring/blob/master/app/Ttf/AlgorithmSpecializedMappingS.php "app/Ttf/AlgorithmSpecializedMappingS.php")
10. [Implementation: AlgorithmSpecializedMappingT.php](https://github.com/rusbal/tidtilforsikring/blob/master/app/Ttf/AlgorithmSpecializedMappingT.php "app/Ttf/AlgorithmSpecializedMappingT.php")

##Test using browser
1. Run ```$ php artisan serve```
2. Open http://localhost:8000/

##Invalid input
![Alt](https://github.com/rusbal/tidtilforsikring/blob/master/TTF-Invalid.png?raw=true "Test result")

##(base) A && B && !C => X = S
![Alt](https://github.com/rusbal/tidtilforsikring/blob/master/TTF-Base-S.png?raw=true "Test result")

##(base) A && B && C => X = R
![Alt](https://github.com/rusbal/tidtilforsikring/blob/master/TTF-Base-R.png?raw=true "Test result")

##(base) !A && B && C => X = T
![Alt](https://github.com/rusbal/tidtilforsikring/blob/master/TTF-Base-T.png?raw=true "Test result")

##(specialized 1) X = R => Y = 2D + (D * E / 100)
![Alt](https://github.com/rusbal/tidtilforsikring/blob/master/TTF-Specialized-R.png?raw=true "Test result")

##(specialized 2) A && B && !C => X = T
![Alt](https://github.com/rusbal/tidtilforsikring/blob/master/TTF-Specialized-T.png?raw=true "Test result")

##(specialized 2) A && !B && C => X = S
X = S => Y = F + D + (D * E / 100)
![Alt](https://github.com/rusbal/tidtilforsikring/blob/master/TTF-Specialized-S.png?raw=true "Test result")
