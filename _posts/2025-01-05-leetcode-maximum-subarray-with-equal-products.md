---
layout: distill
title: 3411. Maximum Subarray With Equal Products
description:
tags: leetcode, apple
giscus_comments: true
date: 2024-12-14
featured: true

authors:
  - name: Quoc Nguyen
    url: "https://quocnh.github.io"
    affiliations:
      name: Data Science Enthusiast

bibliography: references.bib
toc:
  - name: brute force

---

You are given an array of positive integers nums.

An array arr is called product equivalent if prod(arr) == lcm(arr) * gcd(arr), where:

prod(arr) is the product of all elements of arr.
gcd(arr) is the GCD of all elements of arr.
lcm(arr) is the LCM of all elements of arr.

Return the length of the longest product equivalent subarray of nums.

A subarray is a contiguous non-empty sequence of elements within an array.

The term gcd(a, b) denotes the greatest common divisor of a and b.

The term lcm(a, b) denotes the least common multiple of a and b.

 

Example 1:

Input: nums = [1,2,1,2,1,1,1]

Output: 5

Explanation: 

The longest product equivalent subarray is [1, 2, 1, 1, 1], where prod([1, 2, 1, 1, 1]) = 2, gcd([1, 2, 1, 1, 1]) = 1, and lcm([1, 2, 1, 1, 1]) = 2.

Example 2:

Input: nums = [2,3,4,5,6]

Output: 3

Explanation: 

The longest product equivalent subarray is [3, 4, 5].

Example 3:

Input: nums = [1,2,3,1,4,5,1]

Output: 5

 
    
## brute force
Time: O(n)

Space: O(n)

```python
class Solution(object):
    
    # Function to calculate the GCD of two numbers
    def compute_gcd(self, a, b):
        while b:
            a, b = b, a % b
        return a
    
    # Function to calculate the GCD of a list
    def gcd_of_list(self, arr):
        result = arr[0]
        for num in arr[1:]:
            result = self.compute_gcd(result, num)
        return result
    
    # Function to calculate the LCM of two numbers
    def compute_lcm(self, a, b):
        return (a * b) // self.compute_gcd(a, b)
    
    # Function to calculate the LCM of a list
    def lcm_of_list(self, arr):
        result = arr[0]
        for num in arr[1:]:
            result = self.compute_lcm(result, num)  # Fixed 'self.result' -> 'result'
        return result
    
    # Function to calculate the product of a list
    def product_of_list(self, arr):
        result = 1
        for num in arr:
            result *= num
        return result
    
    def maxLength(self, nums):
        """
        :type nums: List[int]
        :rtype: int
        """
        n = len(nums)
        max_length = 0
        
        # Try every subarray starting at index i and ending at index j
        for i in range(n):
            for j in range(i, n):
                subarray = nums[i:j+1]
                product = self.product_of_list(subarray)
                gcd_value = self.gcd_of_list(subarray)
                lcm_value = self.lcm_of_list(subarray)
                
                # Check if the condition holds
                if product == lcm_value * gcd_value:
                    max_length = max(max_length, j - i + 1)
        
        return max_length
        
```

