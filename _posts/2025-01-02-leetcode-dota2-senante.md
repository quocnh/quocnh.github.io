---
layout: distill
title: 649. Dota2 Senate
description:
tags: leetcode, apple
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
  - name: queue

---

The Dota2 Senate problem is a programming challenge that comes from the online coding platform LeetCode. It’s inspired by the mechanics of the game Dota2 but framed in a decision-making scenario with two factions, Radiant and Dire. Here's a breakdown of the problem:

Problem Description:
In the Dota2 world, there are two parties, Radiant and Dire, who compete in a senate decision-making process. Each senator has one vote, and they can use it to:

Ban one senator from the opposing party.
Proceed to the next round.
The voting process continues round by round, and at each step:

If a senator is banned, they cannot participate in any further rounds.
The party that cannot field any senators loses, and the other party wins.
The goal is to predict which party will win based on the initial arrangement of senators in the senate.

The input is a string representing the initial senate arrangement:

'R' for Radiant.

'D' for Dire.

Example:

Input: "RDD"
Output: "Dire"

    
## queue
Time: O(n)

Space: O(n)

```python

from collections import deque

def predictPartyVictory(senate: str) -> str:
    radiant = deque()
    dire = deque()
    
    # Initialize queues with indices of senators
    for i, senator in enumerate(senate):
        if senator == 'R':
            radiant.append(i)
        else:
            dire.append(i)
    # radiant = deque(i for i, ch in enumerate(senate) if ch == "R")
    # dire = deque(i for i, ch in enumerate(senate) if ch == "D")
    n = len(senate)
    
    # Process the rounds
    while radiant and dire:
        r = radiant.popleft() # if dont use deque, use queue, then we can use pop(0)
        d = dire.popleft()
        
        # The senator with the smaller index bans the other
        if r < d:
            radiant.append(r + n)  # Requeue to vote in the next round
        else:
            dire.append(d + n)  # Requeue to vote in the next round
    
    return "Radiant" if radiant else "Dire"

```

