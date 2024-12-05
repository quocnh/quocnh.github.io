---
layout: distill
title: Python Data Structures: List, Set, Stack, and Queue
description:
tags: leetcode
giscus_comments: true
date: 2024-12-04
featured: true

authors:
  - name: Quoc Nguyen
    url: "https://quocnh.github.io"
    affiliations:
      name: Data Science Enthusiast

bibliography: references.bib
toc:
  - name: Python Data Structures: List, Set, Stack, and Queue
  - name: Overview

---


# Python Data Structures: List, Set, Stack, and Queue

## Overview

| Feature               | **List**                    | **Set**                     | **Stack**                   | **Queue**                   |
|-----------------------|----------------------------|-----------------------------|-----------------------------|-----------------------------|
| **Definition**         | Ordered collection of elements, allows duplicates. | Unordered collection of unique elements. | Last-In-First-Out (LIFO).   | First-In-First-Out (FIFO). |
| **Duplicates Allowed** | ✅ Yes                    | ❌ No                      | ✅ Yes                     | ✅ Yes                     |
| **Ordering**           | ✅ Yes                    | ❌ No                      | ✅ Yes                     | ✅ Yes                     |

# Python Data Structures: List, Set, Stack, and Queue

- List: Ordered, allows duplicates.
- Set: Unordered, unique elements only.
- Stack: Last-In-First-Out (LIFO).
- Queue: First-In-First-Out (FIFO).



## 1. LIST
### Definition
```python
my_list = []  # Empty list
my_list = [1, 2, 3, 4]  # List with elements
```
### Common Operations
```python
my_list.append(5)  # Add an element, [1, 2, 3, 4, 5]
print(my_list[0])  # Access by index, Output: 1
my_list.remove(2)  # Remove by value, [1, 3, 4, 5]
print(my_list[1:3])  # Slice, Output: [3, 4]

# Time Complexities
# Append: O(1)
# Access by Index: O(1)
# Remove (by Value): O(n)
# Slice: O(k)
```
## 2. SET
### Definition
```python
my_set = set()  # Empty set
my_set = {1, 2, 3}  # Set with elements
```
### Common Operations
```python
my_set.add(4)  # Add an element, {1, 2, 3, 4}
my_set.remove(2)  # Remove an element, {1, 3, 4}
print(3 in my_set)  # Membership check, Output: True

# Time Complexities
# Add: O(1)
# Remove: O(1)
# Membership Check: O(1)
```
## 3. STACK
### Definition
```python
my_stack = []  # Empty stack
my_stack = [1, 2, 3]  # Stack with elements
```
### Common Operations
```python
my_stack.append(4)  # Push (add), [1, 2, 3, 4]
top = my_stack.pop()  # Pop (remove top), Output: 4, stack becomes [1, 2, 3]
print(my_stack[-1])  # Peek (view top), Output: 3

# Time Complexities
# Push: O(1)
# Pop: O(1)
# Peek: O(1)
```

## 4. QUEUE
from collections import deque

### Definition
```python
my_queue = deque()  # Empty queue
my_queue = deque([1, 2, 3])  # Queue with elements
```
### Common Operations
```python
my_queue.append(4)  # Enqueue (add to end), deque([1, 2, 3, 4])
front = my_queue.popleft()  # Dequeue (remove from front), Output: 1, queue becomes deque([2, 3, 4])
print(my_queue[0])  # Peek (view front), Output: 2

# Time Complexities
# Enqueue: O(1)
# Dequeue: O(1)
# Peek: O(1)
```

## Summary Table (Conceptual)
 | Operation             | List   | Set   | Stack | Queue |
 |-----------------------|--------|-------|-------|-------|
 | Add Element           | O(1)  | O(1)  | O(1)  | O(1)  |
 | Remove Element        | O(n)  | O(1)  | O(1)  | O(1)  |
 | Access Element        | O(1)  | O(1)  | O(1)  | O(1)  |
 | Membership Check      | O(n)  | O(1)  | O(n)  | O(n)  |
 | Order Maintained      | Yes    | No    | Yes   | Yes   |
 | Duplicates Allowed    | Yes    | No    | Yes   | Yes   |

## When to Use Each
 1. List: General-purpose storage, ordered, allows duplicates.
    Example: Storing items with duplicates, accessing by index.
 2. Set: Unique elements, fast membership checks.
    Example: Removing duplicates, set operations like union.
 3. Stack: LIFO operations (Last-In-First-Out).
    Example: Backtracking, parsing expressions.
 4. Queue: FIFO operations (First-In-First-Out).
    Example: Task scheduling, breadth-first search (BFS).
