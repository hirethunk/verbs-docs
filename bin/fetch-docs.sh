#!/bin/bash

# Exit on errors
set -e

# Move into project root
BIN_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
cd "$BIN_DIR"
cd ..

DOCS_VERSIONS=(
  main
)

for v in "${DOCS_VERSIONS[@]}"; do
    if [ -d "storage/docs/_tmp" ]; then
        echo "Removing previous temp files..."
        rm -rf storage/docs/_tmp
    fi
    
    echo "Cloning $v..."
    git clone --single-branch --branch "$v" https://github.com/hirethunk/verbs "storage/docs/_tmp"
    
    echo "Copying $v docs..."
    mv "storage/docs/_tmp/docs" "storage/docs/$v"
    
    echo "Removing temp files..."
    rm -rf storage/docs/_tmp
done
