<?php


function getTokenData($token)
{
    $sql = "SELECT *  FROM verify_token WHERE token = ? AND expired_at < NOW()";
    return pdo_query_one($sql, $token);
}
