---
layout: distill
title: 206. Reverse Linked List
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
  - name: Two Pointers
  - name: Using Stack

---
```python
Given the head of a singly linked list, reverse the list, and return the reversed list.

Example 1:

Input: head = [1,2,3,4,5]
Output: [5,4,3,2,1]

Example 2:

Input: head = [1,2]
Output: [2,1]

Example 3:

Input: head = []
Output: []

 

Constraints:

    The number of nodes in the list is the range [0, 5000].
    -5000 <= Node.val <= 5000

 

Follow up: A linked list can be reversed either iteratively or recursively. Could you implement both?

```

## Two Pointers
```python
# Definition for singly-linked list.
# class ListNode(object):
#     def __init__(self, val=0, next=None):
#         self.val = val
#         self.next = next
class Solution(object):
    def reverseList(self, head):
        """
        :type head: Optional[ListNode]
        :rtype: Optional[ListNode]
        """
        # 1 -> 2 -> 3 -> 4 - > 5 -> None
        # Use 2 pointers

        prev = None
        current = head

        while current: # while current is still not None
            # swap the prev and current nodes
            next_node = current.next
            current.next = prev
            prev = current
            current = next_node
            
        return prev # new head
```
## Using Stack
