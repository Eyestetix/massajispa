#!/usr/bin/env python3
import subprocess
import os

WEBSITE_DIR = '/Volumes/PROJECTS/EYESTETIX_BACKUP_2026-09-30/WEBSITE'
compiler = os.path.join(WEBSITE_DIR, 'compile_complete_site.py')

res = subprocess.run(['python3', compiler], capture_output=True, text=True)
print(res.stdout)
if res.stderr:
    print("Error:", res.stderr)
