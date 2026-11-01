#!/usr/bin/env python3
import subprocess
import os

WEBSITE_DIR = os.path.dirname(os.path.abspath(__file__))
compiler = os.path.join(WEBSITE_DIR, 'compile_complete_site.py')

res = subprocess.run(['python3', compiler], cwd=WEBSITE_DIR, capture_output=True, text=True)
print(res.stdout)
if res.stderr:
    print("Error:", res.stderr)
