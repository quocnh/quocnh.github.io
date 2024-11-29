---
layout: distill
title: 334. Increasing Triplet Subsequence

description: 
tags: leetcode
giscus_comments: true
date: 2024-11-28
featured: true

authors:
  - name: Quoc Nguyen
    url: "https://quocnh.github.io"
    affiliations:
      name: Data Science Enthusiast

bibliography: references.bib

toc:
  - name: Prefix Sum


---

Given an integer array nums, return an array answer such that answer[i] is equal to the product of all the elements of nums except nums[i].

The product of any prefix or suffix of nums is guaranteed to fit in a 32-bit integer.

You must write an algorithm that runs in O(n) time and without using the division operation.

 
```css
Given an integer array nums, return true if there exists a triple of indices (i, j, k) such that i < j < k and nums[i] < nums[j] < nums[k]. If no such indices exists, return false.

 

Example 1:

Input: nums = [1,2,3,4,5]
Output: true
Explanation: Any triplet where i < j < k is valid.
Example 2:

Input: nums = [5,4,3,2,1]
Output: false
Explanation: No triplet exists.
Example 3:

Input: nums = [2,1,5,0,4,6]
Output: true
Explanation: The triplet (3, 4, 5) is valid because nums[3] == 0 < nums[4] == 4 < nums[5] == 6.
```

Why float('inf') Fits Here
In the Increasing Triplet Subsequence problem:

first is initialized to float('inf') so that it can easily be replaced with the smallest number in the array during the first pass.
Similarly, second starts as float('inf') so it can be updated with the second smallest number after first is identified.

```python
class Solution(object):
    def increasingTriplet(self, nums):
        """
        :type nums: List[int]
        :rtype: bool
        """
        first = float('inf')  # Smallest number
        second = float('inf')  # Second smallest number
        
        for num in nums:
            if num <= first:
                first = num  # Update smallest
            elif num <= second:
                second = num  # Update second smallest
            else:
                # If we find a number greater than both `first` and `second`,
                # we have an increasing triplet
                return True
        
        return False

```
