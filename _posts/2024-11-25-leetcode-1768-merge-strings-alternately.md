---
layout: distill
title: 1768. Merge Strings Alternately
description: 
tags: leetcode
giscus_comments: true
date: 2024-11-25
featured: true

authors:
  - name: Quoc Nguyen
    url: "https://example.com"
    affiliations:
      name: Data Science Enthusiast

bibliography: references.bib

toc:
  - name: Two Pointers Solution
  - name: One Pointer Solution

---

## Two Pointers Solution
# Intuition
<!-- Describe your first thoughts on how to solve this problem. -->

# Approach
<!-- Describe your approach to solving the problem. -->

# Complexity
- Time complexity:
<!-- Add your time complexity here, e.g. $$O(n)$$ -->

- Space complexity:
<!-- Add your space complexity here, e.g. $$O(n)$$ -->

# Two Pointers Solution
```python []
class Solution(object):
    def mergeAlternately(self, word1, word2):
        """
        :type word1: str
        :type word2: str
        :rtype: str
        """
        str = ""
        i = 0
        j = 0
        while(i!=len(word1) or j!=len(word2)):
            if i!=len(word1):
                str += word1[i]
                i+=1
            if j != len(word2):
                str += word2[j]
                j+=1
        return str
```
## One Pointer Solution
```python
class Solution(object):
    def mergeAlternately(self, word1, word2):
        """
        :type word1: str
        :type word2: str
        :rtype: str
        """
        ## One pointer solution

        str = ""
        for i in range(max(len(word1), len(word2))):
            if i < len(word1):
                str += word1[i]
            if i < len(word2):
                str += word2[i]
        return str
```
