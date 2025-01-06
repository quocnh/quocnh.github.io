---
layout: distill
title: 3412. Find Mirror Score of a String
description:
tags: leetcode, apple
giscus_comments: true
date: 2025-01-05
featured: true

authors:
  - name: Quoc Nguyen
    url: "https://quocnh.github.io"
    affiliations:
      name: Data Science Enthusiast

bibliography: references.bib
toc:
  - name: brute force
  - stack

---

You are given a string s.

We define the mirror of a letter in the English alphabet as its corresponding letter when the alphabet is reversed. For example, the mirror of 'a' is 'z', and the mirror of 'y' is 'b'.

Initially, all characters in the string s are unmarked.

You start with a score of 0, and you perform the following process on the string s:

Iterate through the string from left to right.
At each index i, find the closest unmarked index j such that j < i and s[j] is the mirror of s[i]. Then, mark both indices i and j, and add the value i - j to the total score.
If no such index j exists for the index i, move on to the next index without making any changes.
Return the total score at the end of the process.

 

Example 1:

Input: s = "aczzx"

Output: 5

Explanation:

i = 0. There is no index j that satisfies the conditions, so we skip.
i = 1. There is no index j that satisfies the conditions, so we skip.
i = 2. The closest index j that satisfies the conditions is j = 0, so we mark both indices 0 and 2, and then add 2 - 0 = 2 to the score.
i = 3. There is no index j that satisfies the conditions, so we skip.
i = 4. The closest index j that satisfies the conditions is j = 1, so we mark both indices 1 and 4, and then add 4 - 1 = 3 to the score.

 
    
## brute force
## instructions:

# ✅ **Brute Force Explanation:**

### **Process:**

- **Initialize:** `score = 0`, `marked = [False, False, False, False, False]`

### **Step by Step:**

- **i = 0** → Character `'a'`
    - No previous unmarked mirror → skip.
- **i = 1** → Character `'c'`
    - No previous unmarked mirror → skip.
- **i = 2** → Character `'z'`
    - Closest unmarked mirror:
        - `'a'` at index `0` is the mirror of `'z'`.
        - Mark both `0` and `2`.
        - **Score += (2 - 0) = 2**
    - `marked = [True, False, True, False, False]`
- **i = 3** → Character `'z'`
    - No previous unmarked mirror → skip.
- **i = 4** → Character `'x'`
    - Closest unmarked mirror:
        - `'c'` at index `1` is the mirror of `'x'`.
        - Mark both `1` and `4`.
        - **Score += (4 - 1) = 3**
    - `marked = [True, True, True, False, True]`

### **Final Score:**

- **2 + 3 = 5**

---

---

# ✅ **Stack-Based Optimized Approach:**

### **Process:**

- Use a **stack (dictionary)** to track unmarked characters.
- If a mirror is found, calculate the score and remove it from the stack.

---

### **Step by Step:**

- **Initialize:** `score = 0`, `stack = {}`

### **Step 1:** `'a'`

- Mirror = `'z'`.
- No mirror `'z'` in the stack.
- Add `'a'` to stack:
    - `stack = {'a': [0]}`

---

### **Step 2:** `'c'`

- Mirror = `'x'`.
- No mirror `'x'` in the stack.
- Add `'c'` to stack:
    - `stack = {'a': [0], 'c': [1]}`

---

### **Step 3:** `'z'`

- Mirror = `'a'`.
- Mirror `'a'` exists in stack at index `0`.
- **Score += (2 - 0) = 2**
- Remove `0` from stack.
    - `stack = {'c': [1]}`

---

### **Step 4:** `'z'`

- Mirror = `'a'`.
- No unmarked `'a'` left.
- Add `'z'` to stack.
    - `stack = {'c': [1], 'z': [3]}`

---

### **Step 5:** `'x'`

- Mirror = `'c'`.
- Mirror `'c'` exists in stack at index `1`.
- **Score += (4 - 1) = 3**
- Remove `1` from stack.
    - `stack = {'z': [3]}`

---

### **Final Score:**

- **2 + 3 = 5**

---

# ✅ **Final Answer:**

Both **Brute Force** and **Stack-Based** approaches return the **correct score of 5**.

### **Key Takeaways:**

- The **brute force** checks all previous unmarked characters, so it is slower (`O(n^2)`).
- The **stack-based** approach tracks only the unmarked characters efficiently, achieving `O(n)` time complexity.

---

## code:

```python
# copy your solution here

class Solution(object):
    def calculateScore(self, s):
        """
        :type s: str
        :rtype: int
        """
        # brute force
        #Brute Force Approach:
        #Steps:
        
        #Traverse through the string.
        #For each character s[i], find the closest unmarked index j.
        #If a match is found, mark both and update the score.

        def get_mirror(char):
            return chr(ord('z') - (ord(char) - ord('a')))

        n = len(s)
        marked = [False] * n  # To keep track of marked indices
        score = 0

        for i in range(n):
            if marked[i]:
                continue
            mirror_char = get_mirror(s[i])
            # Search for the closest unmarked j < i
            for j in range(i - 1, -1, -1):
                if not marked[j] and s[j] == mirror_char:
                    marked[i] = marked[j] = True
                    score += i - j
                    break  # Stop after finding the closest match

        return score

        # def get_mirror(char):
        # # Returns the mirror character based on the reverse alphabet mapping
        #     return chr(ord('z') - (ord(char) - ord('a')))
    
        # score = 0
        # stack = {}  # Dictionary with lists to store unmarked characters' indices

        # for i, char in enumerate(s):
        #     mirror_char = get_mirror(char)
            
        #     # If a mirror character exists in the stack, use the closest (last added) one
        #     if mirror_char in stack and stack[mirror_char]:
        #         j = stack[mirror_char].pop()  # Get the closest match
        #         score += i - j
        #     else:
        #         # If no mirror is available, store the current index for future matching
        #         if char not in stack:
        #             stack[char] = []
        #         stack[char].append(i)

        # return score
```
