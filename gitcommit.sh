sudo git add .

echo 'Enter the commit message:'
read commitMessage

sudo git commit -m "$commitMessage"

echo 'Enter the name of the branch:'
read branch

sudo git push origin $branch

read