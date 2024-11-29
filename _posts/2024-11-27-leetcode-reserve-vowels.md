---
layout: distill
title: 345. Reverse Vowels of a String
description: 
tags: leetcode
giscus_comments: true
date: 2024-11-27
featured: true

authors:
  - name: Quoc Nguyen
    url: "https://quocnh.github.io"
    affiliations:
      name: Data Science Enthusiast

bibliography: references.bib

toc:
  - name: Two Pointers


---

Given a string s, reverse only all the vowels in the string and return it.

The vowels are 'a', 'e', 'i', 'o', and 'u', and they can appear in both lower and upper cases, more than once.

 
```python
Example 1:

Input: s = "IceCreAm"

Output: "AceCreIm"

Explanation:

The vowels in s are ['I', 'e', 'e', 'A']. On reversing the vowels, s becomes "AceCreIm".

Example 2:

Input: s = "leetcode"

Output: "leotcede"

Constraints:

    1 <= s.length <= 3 * 105
    s consist of printable ASCII characters.

```

## Brute Force

- Time complexity: O(n)
- Memory complexity: O(1)
  

```python
 class Solution(object):
    def reverseVowels(self, s):
        """
        :type s: str
        :rtype: str
        """
        vowels = "aeiouAEIOU"
        vowels = list(vowels)
        s = list(s)
        i = 0
        j = len(s)-1
        # i , j = 0, len(s) -1
        while(i < j):
            if s[i] in vowels and s[j] in vowels:
                # swap
               s[i], s[j] = s[j], s[i]
               i += 1
               j -= 1
            elif s[i] not in vowels:
                i += 1
            elif s[j] not in vowels:
                j -= 1
        return "".join(s)
        # vowels = ['a', 'A', 'e', 'E', 'i', 'I', 'o', 'O', 'u', 'U']
        # my_vowels = []
        # ans = ""
        # for char in s:
        #     if char in vowels:
        #         my_vowels.append(char)
        # for index,char in enumerate(s):
        #     if char in vowels:
        #         ans += str(my_vowels.pop())
        #     else:
        #         ans += str(char)
        # return ans
```
