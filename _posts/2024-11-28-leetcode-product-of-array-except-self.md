---
layout: distill
title: 238. Product of Array Except Self

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
Example 1:

Input: nums = [1,2,3,4]
Output: [24,12,8,6]

Example 2:

Input: nums = [-1,1,0,-3,3]
Output: [0,0,9,0,0]

 

Constraints:

    2 <= nums.length <= 105
    -30 <= nums[i] <= 30
    The product of any prefix or suffix of nums is guaranteed to fit in a 32-bit integer.

 

Follow up: Can you solve the problem in O(1) extra space complexity? (The output array does not count as extra space for space complexity analysis.)
```
## Prefix and Suffix solution

```css
You have an array nums. For each element in nums, calculate the product of all elements except the current one.

Example:
Input: nums = [1, 2, 3, 4]
Output: [24, 12, 8, 6]

    For index 0: Multiply all except nums[0] → 2×3×4=242×3×4=24
    For index 1: Multiply all except nums[1] → 1×3×4=121×3×4=12
    For index 2: Multiply all except nums[2] → 1×2×4=81×2×4=8
    For index 3: Multiply all except nums[3] → 1×2×3=61×2×3=6


---

### Step 1: Compute Left Products
We calculate the **prefix product** (left products) for each index and store it in `output[]`.

| Index `i` | `nums[i]` | Left Product (`prefix`) | `output` (stores left products) |
|-----------|-----------|-------------------------|----------------------------------|
| 0         | 1         | 1 (no left elements)     | 1                                |
| 1         | 2         | 1 (product of [1])       | 1                                |
| 2         | 3         | 2 (product of [1, 2])    | 2                                |
| 3         | 4         | 6 (product of [1, 2, 3]) | 6                                |

**Output after this step**:
output = [1, 1, 2, 6]


---

### Step 2: Compute Right Products and Multiply with Left Products
We now compute the **suffix product** (right products) and multiply it directly into the `output[]` array.

| Index `i` | Right Product (`suffix`) | `output[i]` (multiplied with suffix) |
|-----------|--------------------------|--------------------------------------|
| 3         | 1                        | \(6 \times 1 = 6\)                   |
| 2         | 4 (product of [4])        | \(2 \times 4 = 8\)                   |
| 1         | 12 (product of [3, 4])    | \(1 \times 12 = 12\)                 |
| 0         | 24 (product of [2, 3, 4]) | \(1 \times 24 = 24\)                 |

**Output after this step**:
output = [24, 12, 8, 6]


---

### Key Points:
- During the **first pass** (left-to-right), we populate `output[]` with the cumulative product of all elements to the left of each index.
- In the **second pass** (right-to-left), we multiply the existing `output[i]` (containing the left product) by the suffix product.

This avoids redundant recalculations and runs in \(O(n)\) time complexity.


```
```css
# class Solution(object):
#     def productExceptSelf(self, nums):
#         """
#         :type nums: List[int]
#         :rtype: List[int]
#         """
#         left=[]
#         right=[]
#         output = []
#         left_product, right_product = 1,1
#         for i in range(len(nums)):
#             left= nums[0:i]
#             right = nums[i+1:len(nums)]

#             for j in left:
#                 left_product *= j
#             for j in right:
#                 right_product *= j

#             output.append(left_product * right_product)
#             left_product, right_product = 1,1
#         return output
class Solution:
    def productExceptSelf(self, nums):
   

        n = len(nums)
        output = [1] * n  # Initialize output array with 1s
        
        # Compute prefix products
        prefix = 1
        for i in range(n):
            output[i] = prefix
            prefix *= nums[i]
        
        # Compute suffix products and multiply with prefix products
        suffix = 1
        for i in range(n - 1, -1, -1):
            output[i] *= suffix
            suffix *= nums[i]
        
        return output

#     def productExceptSelf(self, nums):

#         # The length of the input array
#         length = len(nums)

#         # The left and right arrays as described in the algorithm
#         L, R, answer = [0] * length, [0] * length, [0] * length

#         # L[i] contains the product of all the elements to the left
#         # Note: for the element at index '0', there are no elements to the left,
#         # so the L[0] would be 1
#         L[0] = 1
#         for i in range(1, length):

#             # L[i - 1] already contains the product of elements to the left of 'i - 1'
#             # Simply multiplying it with nums[i - 1] would give the product of all
#             # elements to the left of index 'i'
#             L[i] = nums[i - 1] * L[i - 1]

#         # R[i] contains the product of all the elements to the right
#         # Note: for the element at index 'length - 1', there are no elements to the right,
#         # so the R[length - 1] would be 1
#         R[length - 1] = 1
#         for i in reversed(range(length - 1)):

#             # R[i + 1] already contains the product of elements to the right of 'i + 1'
#             # Simply multiplying it with nums[i + 1] would give the product of all
#             # elements to the right of index 'i'
#             R[i] = nums[i + 1] * R[i + 1]

#         # Constructing the answer array
#         for i in range(length):
#             # For the first element, R[i] would be product except self
#             # For the last element of the array, product except self would be L[i]
#             # Else, multiple product of all elements to the left and to the right
#             answer[i] = L[i] * R[i]

#         return answer
```
