# TTF ASSIGNMENT

###Base
A && B && !C => X = S

A && B && C => X = R

!A && B && C => X = T

[other] => [error]

X = S => Y = D + (D * E / 100)

X = R => Y = D + (D * (E - F) / 100)

X = T => Y = D - (D * F / 100)

###Specialized 1

X = R => Y = 2D + (D * E / 100)

###Specialized 2

A && B && !C => X = T
Here, I computed Y using the same formula for above when X = T.

A && !B && C => X = S

X = S => Y = F + D + (D * E / 100)