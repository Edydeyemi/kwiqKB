<?php

namespace kwiqKB;

echo "I love Indomie";

echo APPNAME . " " . HOME;

// var_dump((new Article())->fetchRecords());
var_dump((new Article())->viewArticle(29) );
// var_dump((new ArticleListing())->listRelatedArticles() );

// Article