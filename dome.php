<?php
/**
 * @Author: 张可
 * @Date:   2017-03-11 17:06:07
 * @Last Modified by:   张可
 * @Last Modified time: 2017-03-12 14:23:36
 */
  $redis = new Redis();
 $redis->connect('127.0.0.1',6379);
 $redis->set('test','hello redis');
  echo $redis->get('test');

 $e= new ReflectionClass("pdo");
 var_dump($e->getMethods());