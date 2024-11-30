---
layout: distill
title: 392. Is Subsequence
description: 
tags: leetcode
giscus_comments: true
date: 2024-11-30
featured: true

authors:
  - name: Quoc Nguyen
    url: "https://quocnh.github.io"
    affiliations:
      name: Data Science Enthusiast

bibliography: references.bib

toc:
  - name: Stack
  - name: Two pointers

---

Given two strings s and t, return true if s is a subsequence of t, or false otherwise.

A subsequence of a string is a new string that is formed from the original string by deleting some (can be none) of the characters without disturbing the relative positions of the remaining characters. (i.e., "ace" is a subsequence of "abcde" while "aec" is not).

 
```python
Example 1:

Input: s = "abc", t = "ahbgdc"
Output: true

Example 2:

Input: s = "axc", t = "ahbgdc"
Output: false
```
 

## Stack

- Time complexity: O(n)
- Memory complexity: O(n)

```python
class Solution(object):
    def isSubsequence(self, s, t):
        """
        :type s: str
        :type t: str
        :rtype: bool
        """

        stack = list(s[::-1])
    
        for i in t:
            # if stack is not empty, and compare the last element to i
            if stack and i == stack[-1]:
                stack.pop()
        return not stack
```

## Two pointers

- Time complexity: O(n)
- Memory complexity: O(1)


```python
class Solution(object):
    def isSubsequence(self, s, t):
        i, j = 0, 0  # Two pointers for s and t
        
        while i < len(s) and j < len(t):
            if s[i] == t[j]:
                i += 1  # Match found, move the s pointer
            j += 1  # Always move the t pointer
        
        return i == len(s)  # True if all characters in s are matched

```
