---
layout: distill
title: 560. Subarray Sum Equals K
description:
tags: leetcode
giscus_comments: true
date: 2024-12-25
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

```python
The problem "560. Subarray Sum Equals K" is about finding all the contiguous subarrays of a given array whose elements sum up to a given integer 
𝑘

Understanding with Examples
Example 1:
Input: nums = [1, 1, 1], k = 2
Output: 2
Explanation:

The contiguous subarrays of nums are:
[1] → Sum = 1
[1, 1] → Sum = 2 (valid)
[1, 1, 1] → Sum = 3
[1] → Sum = 1
[1, 1] → Sum = 2 (valid)
There are 2 subarrays whose sum equals 
𝑘 = 2
```

## Prifix Sum
- Time complexity: O(n)
- Space complexity: O(n)

  
```python

def subarraySum(nums, k):
    count = 0
    runningSum = 0
    hashmap = {0: 1}  # Initialize with {0: 1}
    
    for num in nums:
        runningSum += num
        
        # Check if (runningSum - k) exists in the hashmap
        if runningSum - k in hashmap:
            count += hashmap[runningSum - k]
        
        # Update the hashmap with the current runningSum
        hashmap[runningSum] = hashmap.get(runningSum, 0) + 1
    
    return count   
```
