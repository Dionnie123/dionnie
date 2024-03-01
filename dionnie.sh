#!/bin/bash

case "$1" in
  nf)
    echo "Creating a new text file with 'Hello, World!'"
    echo "Hello, World!" > new_file.txt
    ;;
  foo)
    echo "Executing 'foo' command"
    # Add your 'foo' command logic here
    ;;
  *)
    echo "Unknown command. Usage: dionnie {nf|foo}"
    ;;
esac