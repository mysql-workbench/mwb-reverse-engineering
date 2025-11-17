# MySQL Workbench reverse code
Generate a stub-like of structs.h
All the files to be generated are already in /data/
This repository is used to update/patch model of mwb-dom

# require
 - LLVM
 - PHP

# Step 1
test/main.cc analyse c header source and generate a php stub-like in data/

Key point : GrtStructVisitor::visit(TranslationUnitAST *ast)

# Step 2
src/*.php generate <generate>/Mwb/Grt/*.php

# Step 3
Patch mysql-workbench/mwb-dom
