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
  echo ""
  echo "Fetching '$v' docs"
  echo "======================================"
  echo ""
  
  if [ -d "storage/docs/_tmp" ]; then
    echo "Removing previous temp files..."
    rm -rf storage/docs/_tmp
  fi
  
  echo "Cloning $v..."
  git clone --quiet --single-branch --branch "$v" git@github.com:hirethunk/verbs.git "storage/docs/_tmp"
  
  if [ -d "storage/docs/$v" ]; then
    echo "Removing previous copy of $v..."
    rm -rf "storage/docs/$v"
  fi
  
  echo "Copying $v docs..."
  mkdir -p "storage/docs/$v"
  mv -f "storage/docs/_tmp/docs" "storage/docs/$v/docs"
  mv -f "storage/docs/_tmp/examples" "storage/docs/$v/examples"
  
  echo "Removing temp files..."
  rm -rf storage/docs/_tmp
  
  echo ""
done
