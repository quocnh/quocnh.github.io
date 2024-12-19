---
layout: distill
title: 872. Leaf-Similar Trees
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
  - name: DFS

---

```python
The problem "872. Leaf-Similar Trees" is a LeetCode problem that asks you to determine if two binary trees are leaf-similar. Two trees are leaf-similar if their leaf values are the same when traversed from left to right.

Here is the problem breakdown and a solution:

Problem Statement

Consider all the leaves of a binary tree. A leaf is a node with no children. A binary tree is considered leaf-similar if its leaf values, when visited from left to right, are identical to another binary tree's leaf values.

Given the roots of two binary trees root1 and root2, return true if and only if the two trees are leaf-similar.

root1 = [3,5,1,6,2,9,8,null,null,7,4]
root2 = [3,5,1,6,7,4,2,null,null,null,null,null,null,9,8]

return True
```

## DFS
- Time complexity: O(n)
- Space complexity: O(a + b)
```python
# Definition for a binary tree node.
# class TreeNode(object):
#     def __init__(self, val=0, left=None, right=None):
#         self.val = val
#         self.left = left
#         self.right = right
class Solution(object):
    def leafSimilar(self, root1, root2):
        """
        :type root1: Optional[TreeNode]
        :type root2: Optional[TreeNode]
        :rtype: bool
        """
        # DFS
        def get_leaf_values(node):
            if not node:
                return []
            if not node.left and not node.right:
                return [node.val]
            return get_leaf_values(node.left) + get_leaf_values(node.right)
         # Get leaf sequences for both trees
        leaves1 = get_leaf_values(root1)
        leaves2 = get_leaf_values(root2)
        
        # Compare the sequences
        return leaves1 == leaves2
        
```

