---
layout: distill
title: 437. Path Sum III
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

Given the root of a binary tree and an integer targetSum, return the number of paths where the sum of the values along the path equals targetSum.

The path does not need to start or end at the root or a leaf, but it must go downwards (i.e., traveling only from parent nodes to child nodes).

 

Example 1:

Input: root = [10,5,-3,3,2,null,11,3,-2,null,1], targetSum = 8
Output: 3

Explanation: The paths that sum to 8 are shown.
Example 2:

Input: root = [5,4,8,11,null,13,4,7,2,null,null,5,1], targetSum = 22
Output: 3

## Prifix Sum
- Time complexity: O(n) , n: number of nodes
- Space complexity: O(h), h: height of tree

  
```python
# # Definition for a binary tree node.
# # class TreeNode(object):
# #     def __init__(self, val=0, left=None, right=None):
# #         self.val = val
# #         self.left = left
# #         self.right = right
# class Solution(object):
#     def pathSum(self, root, targetSum):
#         """
#         :type root: Optional[TreeNode]
#         :type targetSum: int
#         :rtype: int
#         """
#         self.total = 0
#         def helper(node, cur):
#             if not node:
#                 return
            
#             helper(node.left, cur + node.val)
#             helper(node.right, cur + node.val)
#             if node.val + cur == targetSum:
#                 self.total +=1
#         def dfs(node):
#             if not node:
#                 return
#             count = helper(node, 0)
#             dfs(node.left)
#             dfs(node.right)
            
#         dfs(root)
#         return self.total
        

# Definition for a binary tree node.
# class TreeNode:
#     def __init__(self, val=0, left=None, right=None):
#         self.val = val
#         self.left = left
#         self.right = right

class TreeNode:
    def __init__(self, val=0, left=None, right=None):
        self.val = val
        self.left = left
        self.right = right

class Solution:
    def pathSum(self, root, targetSum):
        def dfs(node, currentSum, prefixSums, count):
            if not node:
                return
            
            # Update the current sum
            currentSum += node.val
            
            # Check if there's a prefix sum such that currentSum - targetSum exists
            if currentSum - targetSum in prefixSums:
                count[0] += prefixSums[currentSum - targetSum]
            
            # Update the prefixSums map
            if currentSum in prefixSums:
                prefixSums[currentSum] += 1
            else:
                prefixSums[currentSum] = 1
            
            # Recursively visit left and right subtrees
            dfs(node.left, currentSum, prefixSums, count)
            dfs(node.right, currentSum, prefixSums, count)
            
            # Backtrack: remove the currentSum from prefixSums
            if prefixSums[currentSum] == 1:
                del prefixSums[currentSum]
            else:
                prefixSums[currentSum] -= 1
        
        # Initialize variables
        count = [0]  # Use a list to allow mutation
        prefixSums = {0: 1}  # Base case for when currentSum == targetSum
        
        dfs(root, 0, prefixSums, count)
        return count[0]
```
