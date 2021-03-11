# 基本的な変更
git filter-branch -f --env-filter '
    if test "$GIT_AUTHOR_NAME" = "OdenMaster"
    then
        GIT_AUTHOR_NAME="y-web21"
    fi
    if test "$GIT_COMMITTER_NAME" = "OdenMaster"
    then
        GIT_COMMITTER_NAME="y-web21"
    fi' --tag-name-filter cat -- --all

git push -f

# コミットメッセージに名前があるので変更
git filter-branch -f --msg-filter 'sed -e "s/OdenMaster/y-web21/g"' --tag-name-filter cat -- --all

git push -f
