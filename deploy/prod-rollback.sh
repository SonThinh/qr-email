#!/usr/bin/env bash
ssh-add ~/.ssh/id_rsa
./vendor/bin/dep rollback production -vv