---
layout: distill
title: 1071. Greatest Common Divisor of String
description: 
tags: leetcode
giscus_comments: true
date: 2024-11-26
featured: true

authors:
  - name: Quoc Nguyen
    url: "https://quocnh.github.io"
    affiliations:
      name: Data Science Enthusiast

bibliography: references.bib

toc:
  - name: Brute Force
  - name: Euclidean Algorithm

---

For two strings s and t, we say "t divides s" if and only if s = t + t + t + ... + t + t (i.e., t is concatenated with itself one or more times).

Given two strings str1 and str2, return the largest string x such that x divides both str1 and str2.

 
```python
Example 1:

Input: str1 = "ABCABC", str2 = "ABC"
Output: "ABC"

Example 2:

Input: str1 = "ABABAB", str2 = "ABAB"
Output: "AB"

Example 3:

Input: str1 = "LEET", str2 = "CODE"
Output: ""
```
 

## Brute Force

- Time complexity: O(n)
- Memory complexity: O(1)
  
![](https://github.com/quocnh/quocnh.github.io/blob/55b2f67a46eda40abd0a9ac3122cc63419eb9086/assets/img/1071-Greatest%20Common%20Divisor%20of%20String.png)


```python
 def valid(i):
            if len(str1)%i != 0 or len(str2)%i != 0:
                return False
            ratio1 = len(str1)//i
            ratio2 = len(str2)//i
            base = str1[:i]
            return base*ratio1 == str1 and base*ratio2 == str2

        for i in range (min(len(str1), len(str2)), 0, -1):
            if valid(i):
                return str1[:i]
        return ""
```
## Euclidean Algorithm
- Time complexity: O(Log(Min(Len(Str1),Len(Str2)))
- Memory complexity: O(1)
```python

class Solution(object):
    def gcdOfStrings(self, str1, str2):
        """
        :type str1: str
        :type str2: str
        :rtype: str
        """
       
        ## Euclidean Algorithm:

        # This algorithm works by repeatedly replacing the larger number with the remainder of the division of the two numbers. Mathematically:
        # gcd(a,b)=gcd(b,a%b)
        # The process continues until the remainder (bb) becomes zero.

        def gcd(a,b):
            while b:
                a, b = b, a%b
            return a

        # check if str1 and str2 have common gcd
        if str1 + str2 != str2 + str1:
            return ""
        tmp = gcd(len(str1), len(str2))
        str = str1[:tmp]
        return str
```
