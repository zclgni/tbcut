 #!/bin/bash
   n=0
   while (($n<500))
   do
       sh 1.sh
        n=$((n+1))
       sleep 5
   done

