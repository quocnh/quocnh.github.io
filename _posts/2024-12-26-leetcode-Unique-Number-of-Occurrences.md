---
layout: distill
title: 1207. Unique Number of Occurrences

description:
tags: leetcode
giscus_comments: true
date: 2024-12-26
featured: true

authors:
  - name: Quoc Nguyen
    url: "https://quocnh.github.io"
    affiliations:
      name: Data Science Enthusiast

bibliography: references.bib
toc:
  - name: set and hashmap


---

Given an array of integers arr, return true if the number of occurrences of each value in the array is unique or false otherwise.

 

Example 1:

Input: arr = [1,2,2,1,1,3]

Output: true

Explanation: The value 1 has 3 occurrences, 2 has 2 and 3 has 1. No two values have the same number of occurrences.

Example 2:

Input: arr = [1,2]

Output: false

Example 3:

Input: arr = [-3,0,1,-3,1,1,1,-3,10,0]

Output: true


## set and hashmap
- Time complexity: O(N) 
- Space complexity: O(N),
  
```python
class Solution(object):
    def uniqueOccurrences(self, arr):
        """
        :type arr: List[int]
        :rtype: bool
        """
        hashmap = {}
        # find number of currences
        for i in arr:
            hashmap[i] = hashmap.get(i,0) + 1
        # Check the same # of currences or not

        return len(set(hashmap.values())) == len(hashmap.values())
```
