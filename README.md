# MySQL Workbench reverse code

Generate a stub-like of structs.h

# require
 - LLVM
 - PHP

# Step 1
test/main.cc analyse c header source and generate a php stub-like in data/

# Step 2
src/*.php generate <generate>/Mwb/Grt/*.php

# Step 3
Patch mysql-workbench/mwb-dom
