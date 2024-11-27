---
layout: distill
title: 605. Can Place Flowers
description: 
tags: leetcode
giscus_comments: true
date: 2024-11-26
featured: true

authors:
  - name: Quoc Nguyen
    url: "https://quocnh.github.io"
    affiliations:
      name: Data Science Enthusiast

bibliography: references.bib

toc:
  - name: Solution

---


## Solution

- Time complexity: O(n). A single scan of the flowerbed array of size n is done.
- Space complexity: O(1). Constant extra space is used.

  
```python
class Solution(object):
    def canPlaceFlowers(self, flowerbed, n):
        """
        :type flowerbed: List[int]
        :type n: int
        :rtype: bool
        """
       # Check all current plot has 0 whether it is left_empty_plot or right_empty_plot (check first and last plot)
       # if the current plot has left and right empty, then we can plant a tree ( count ++)
       # if count >= n return True

        count = 0
        for i in range(len(flowerbed)):
            # if (i == 0) or (flowerbed[i-1] == 0)
            #     left_empty_plot = True
            # else:
            #     left_empty_plot = False
            if flowerbed[i] == 0:
                left_empty_plot = (i == 0) or (flowerbed[i-1] == 0)
                right_empty_plot = (i == len(flowerbed)-1) or (flowerbed[i+1] == 0)

                if left_empty_plot and right_empty_plot:
                    flowerbed[i] = 1
                    count += 1
                    if count >= n:
                        return True
        return count >= n

```
