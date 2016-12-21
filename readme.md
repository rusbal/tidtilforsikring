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

This solution is based on Laravel.  My pertinent code is located in 3 files:

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

1. [tests/AlgorithmTest.php](https://github.com/rusbal/tidtilforsikring/blob/master/tests/AlgorithmTest.php "AlgorithmTest.php")
2. [app/Http/Controllers/InsuranceController.php](https://github.com/rusbal/tidtilforsikring/blob/master/app/Http/Controllers/InsuranceController.php "InsuranceController.php")
3. [app/Ttf/Algorithm.php](https://github.com/rusbal/tidtilforsikring/blob/master/app/Ttf/Algorithm.php "Caller class: Algorithm.php")
4. [app/Ttf/AlgorithmBase.php](https://github.com/rusbal/tidtilforsikring/blob/master/app/Ttf/AlgorithmBase.php "Abstract class: AlgorithmBase.php")
5. [app/Ttf/AlgorithmBaseMappingR.php](https://github.com/rusbal/tidtilforsikring/blob/master/app/Ttf/AlgorithmBaseMappingR.php "Implementation: AlgorithmBaseMappingR.php")
6. [app/Ttf/AlgorithmBaseMappingS.php](https://github.com/rusbal/tidtilforsikring/blob/master/app/Ttf/AlgorithmBaseMappingS.php "Implementation: AlgorithmBaseMappingS.php")
7. [app/Ttf/AlgorithmBaseMappingT.php](https://github.com/rusbal/tidtilforsikring/blob/master/app/Ttf/AlgorithmBaseMappingT.php "Implementation: AlgorithmBaseMappingT.php")
8. [app/Ttf/AlgorithmSpecializedMappingR.php](https://github.com/rusbal/tidtilforsikring/blob/master/app/Ttf/AlgorithmSpecializedMappingR.php "Implementation: AlgorithmSpecializedMappingR.php")
9. [app/Ttf/AlgorithmSpecializedMappingS.php](https://github.com/rusbal/tidtilforsikring/blob/master/app/Ttf/AlgorithmSpecializedMappingS.php "Implementation: AlgorithmSpecializedMappingS.php")
10. [app/Ttf/AlgorithmSpecializedMappingT.php](https://github.com/rusbal/tidtilforsikring/blob/master/app/Ttf/AlgorithmSpecializedMappingT.php "Implementation: AlgorithmSpecializedMappingT.php")