---
layout: distill
title: 136. Single Number
description:
tags: leetcode
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
  - name: Bitwise
  - name: Explaination

---

```python
Given a non-empty array of integers nums, every element appears twice except for one. Find that single one.

You must implement a solution with a linear runtime complexity and use only constant extra space.

 

Example 1:

Input: nums = [2,2,1]
Output: 1
Example 2:

Input: nums = [4,1,2,1,2]
Output: 4
Example 3:

Input: nums = [1]
Output: 1
```

## Bitwise
- Time complexity: O(n)
- Space complexity: O(1)
```python
class Solution(object):
    def singleNumber(self, nums):
        """
        :type nums: List[int]
        :rtype: int
        """
        result = 0
        for i in nums:
            result ^= i

        return result 
        
```
## Explaination
### XOR Operation and Its Properties
The XOR operator (`^`) works at the bit level and follows these rules:

1. **Same bits produce 0:**
   - `0 ^ 0 = 0`
   - `1 ^ 1 = 0`

2. **Different bits produce 1:**
   - `0 ^ 1 = 1`
   - `1 ^ 0 = 1`

3. **Key Properties for This Problem:**
   - `a ^ a = 0` (Self-canceling: XOR of a number with itself is 0.)
   - `a ^ 0 = a` (XOR of a number with 0 is the number itself.)
   - XOR is **commutative** and **associative**, meaning the order of operations doesn't matter.

---

### Example Walkthrough

#### Input:
```plaintext
nums = [4, 1, 2, 1, 2]
```

We initialize `result = 0` and process each number in the array using XOR. Let’s track the changes step by step, highlighting **where numbers cancel each other out.**

---

#### Step-by-Step Process

1. **Initial Value:**
   ```plaintext
   result = 0
   ```

2. **Step 1:**
   ```plaintext
   result = 0 ^ 4 = 4
   ```
   - No cancellation yet because this is the first number.

3. **Step 2:**
   ```plaintext
   result = 4 ^ 1 = 5
   ```
   - Still no cancellation because `1` appears for the first time.

4. **Step 3:**
   ```plaintext
   result = 5 ^ 2 = 7
   ```
   - Still no cancellation because `2` appears for the first time.

5. **Step 4:**
   ```plaintext
   result = 7 ^ 1 = 6
   ```
   - **Here, `1` cancels out!**
     - Why? Because `1` appeared earlier in Step 2.
     - When we XOR the same number (`1 ^ 1`), it produces `0`, effectively removing `1` from the result.
     - Binary operation:
       - `7 (111) ^ 1 (001) = 6 (110)`

6. **Step 5:**
   ```plaintext
   result = 6 ^ 2 = 4
   ```
   - **Here, `2` cancels out!**
     - Why? Because `2` appeared earlier in Step 3.
     - When we XOR the same number (`2 ^ 2`), it produces `0`, effectively removing `2` from the result.
     - Binary operation:
       - `6 (110) ^ 2 (010) = 4 (100)`

---

#### Final Result:
```plaintext
result = 4
```
At the end, all duplicate numbers (`1` and `2`) have canceled out, and only the single number `4` remains.

---

### Key Takeaways
1. **Where Does Self-Canceling Happen?**
   - **Step 4:** The duplicate `1` cancels out (`1 ^ 1 = 0`).
   - **Step 5:** The duplicate `2` cancels out (`2 ^ 2 = 0`).

2. **Why XOR Works for This Problem:**
   - Duplicates cancel out because `a ^ a = 0`.
   - The XOR of all numbers leaves only the single number that does not have a duplicate.

---

### Code Implementation
Here is the Python implementation:

```python
class Solution:
    def singleNumber(self, nums):
        result = 0
        for num in nums:
            result ^= num  # XOR all numbers
        return result
```

#### Complexity Analysis
1. **Time Complexity:**
   - O(N): We iterate through the array once.

2. **Space Complexity:**
   - O(1): No additional space is used beyond the variable `result`.

---

### Additional Examples

#### Example 1:
**Input:**
```plaintext
nums = [2, 2, 1]
```
**Output:**
```plaintext
1
```

#### Example 2:
**Input:**
```plaintext
nums = [4, 1, 2, 1, 2]
```
**Output:**
```plaintext
4
```
