<?php
function getCompanies()
{
    $statement = '
    SELECT company_id, name, description, owner, site
    FROM company
    ';
    return _getDBResult($statement);
}

function getProductsByCompanyID($companyID)
{
    $statement = '
    SELECT product_id,
           company_id,
           name,
           description,
           src,
           alt,
           price,
           IFNULL((SELECT AVG(comment.rate) from comment where comment.product_id = product.product_id),0) as rate
    FROM product
    where product.company_id = '."$companyID" ;
    return _getDBResult($statement);
}

function getCommentListByProductID($productID)
{
    $statement = '
    SELECT users.first_name,
           users.last_name,
           comment.timestamp,
           comment.rate,
           comment.comment
           FROM comment join users on comment.user_id = users.id
    where comment.product_id = '."$productID" ;
    return _getDBResult($statement);
}

function getProductInfo($productID)
{
    $statement = '
    SELECT product_id,
           company_id,
           name,
           description,
           src,
           alt,
           price,
           IFNULL((SELECT AVG(comment.rate) from comment where comment.product_id = product.product_id),0) as rate
    FROM product
    WHERE product_id='."$productID";
    return _getDBResult($statement);
}

function getMostRatedEachCompany($num, $companyID)
{
    $statement = '
  select * from (
  SELECT          product_id,
                  company_id,
                  name,
                  description,
                  src,
                  alt,
                  price,
                  rate,
          @student:=CASE WHEN @class <> company_id THEN 0 ELSE @student+1 END AS rank,
          @class:=company_id AS bkt
       FROM
         (SELECT @student:= -1) s,
         (SELECT @class:= -1) c,
         (SELECT *
          FROM
              (SELECT product_id,
                         company_id,
                         name,
                         description,
                         src,
                         alt,
                         price,
                         IFNULL((SELECT AVG(comment.rate) from comment where comment.product_id = product.product_id),0) as rate
                 FROM product)  r
            ORDER BY company_id, rate DESC
           ) t
           ) d
           where d.rank < '."$num".'
           and d.company_id = '."$companyID";
    return _getDBResult($statement);
}

function getMostRatedInMarket($num)
{
    $statement = '
    select a.name as name,
          a.product_id as product_id,
           c.name as company_name,
           a.description as description,
                    a.src as src,
                    a.alt as alt,
                    a.price as price,
                    a.rate as rate
    from (
    SELECT * from (
  SELECT product_id,
         company_id,
         name,
         description,
         src,
         alt,
         price,
         IFNULL((SELECT AVG(comment.rate) from comment where comment.product_id = product.product_id),0) as rate
  FROM product) t
  order by t.rate DESC limit '."$num".' ) a join company c on a.company_id = c.company_id
  ';
    return _getDBResult($statement);
}

function _getDBResult($statement)
{
    include('./content/dbh.php');
    if ($result = mysqli_query($conn, $statement)) {
        if (mysqli_num_rows($result) > 0) {
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
    } else {
        return null;
    }
}
