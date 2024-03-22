#!/bin/bash

# Exit on errors
set -e

# Move into project root
BIN_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
cd "$BIN_DIR"
cd ..

DOCS_VERSIONS=(
  "docs-rewrite-2024-Feb"
)

for v in "${DOCS_VERSIONS[@]}"; do
  echo ""
  echo "Fetching '$v' docs"
  echo "======================================"
  echo ""
  
  if [ -d "resources/docs/_tmp" ]; then
    echo "Removing previous temp files..."
    rm -rf resources/docs/_tmp
  fi
  
  echo "Cloning $v..."
  git clone --quiet --single-branch --branch "$v" git@github.com:hirethunk/verbs.git "resources/docs/_tmp"
  
  if [ -d "resources/docs/$v" ]; then
    echo "Removing previous copy of $v..."
    rm -rf "resources/docs/$v"
  fi
  
  echo "Copying $v docs..."
  mkdir -p "resources/docs/$v"
  mv -f "resources/docs/_tmp/docs" "resources/docs/$v/docs"
  mv -f "resources/docs/_tmp/examples" "resources/docs/$v/examples"
  
  echo "Removing temp files..."
  rm -rf resources/docs/_tmp
  
  echo ""
done
