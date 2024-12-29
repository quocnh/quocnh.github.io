---
layout: distill
title: 53. Maximum Subarray
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
  - name: Brute Force
  - name: Kadane Algorithm

---

Given an integer array nums, find the 
subarray
 with the largest sum, and return its sum.

 

Example 1:

Input: nums = [-2,1,-3,4,-1,2,1,-5,4]
Output: 6

Explanation: The subarray [4,-1,2,1] has the largest sum 6.

Example 2:

Input: nums = [1]

Output: 1

Explanation: The subarray [1] has the largest sum 1.

Example 3:

Input: nums = [5,4,-1,7,8]

Output: 23

Explanation: The subarray [5,4,-1,7,8] has the largest sum 23.
 

Constraints:

1 <= nums.length <= 105
-104 <= nums[i] <= 104
 

Follow up: If you have figured out the O(n) solution, try coding another solution using the divide and conquer approach, which is more subtle.

- Tutorial about Kananes Algorithm

https://medium.com/@rsinghal757/kadanes-algorithm-dynamic-programming-how-and-why-does-it-work-3fd8849ed73d
    
## Brute Force

Time: O(n^2)

Space: O(n)

```python
class Solution(object):
    def maxSubArray(self, nums):
        """
        :type nums: List[int]
        :rtype: int
        """
        # total_max = -float('inf')
        # for i in range(0, len(nums)):
        #     current_subarray = 0
        #     for j in range(i, len(nums)):
        #         current_subarray += nums[j]
        #         total_max = max(total_max, current_subarray)
        # return total_max
```
## Kadane Algorithm
Time Complexity: O(n)
Space Complexity: O(n)


```python
- Kadanes Algorithm: reused the output of smaller subarray for computational efficient
local_max = max(array[i], array[i] + local_max[i-1])

class Solution(object):
    def maxSubArray(self, nums):
        """
        :type nums: List[int]
        :rtype: int
        """
        # total_max = -float('inf')
        # for i in range(0, len(nums)):
        #     current_subarray = 0
        #     for j in range(i, len(nums)):
        #         current_subarray += nums[j]
        #         total_max = max(total_max, current_subarray)
        # return total_max
        local_max = nums[0]
        global_max = nums[0]

        for i in range(1, len(nums)):
            local_max = max(nums[i], local_max + nums[i])
            if (local_max > global_max):
                global_max = local_max
        return global_max
```
