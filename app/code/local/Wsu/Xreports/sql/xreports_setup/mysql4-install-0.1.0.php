<?php

$installer = $this;

$installer->startSetup();

$installer->run("

DROP TABLE IF EXISTS {$this->getTable('xreports_hour')};
CREATE TABLE {$this->getTable('xreports_hour')} (
  `h` int(11),
  `total_item_count` smallint(5),
  `grand_total` decimal(12,4)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
INSERT INTO {$this->getTable('xreports_hour')} (h, total_item_count, grand_total) VALUES(0,0,'0.0000'),(1,0,'0.0000'),(2,0,'0.0000'),(3,0,'0.0000'),(4,0,'0.0000'),(5,0,'0.0000'),(6,0,'0.0000'),(7,0,'0.0000'),(8,0,'0.0000'),(9,0,'0.0000'),(10,0,'0.0000'),(11,0,'0.0000'),(12,0,'0.0000'),(13,0,'0.0000'),(14,0,'0.0000'),(15,0,'0.0000'),(16,0,'0.0000'),(17,0,'0.0000'),(18,0,'0.0000'),(19,0,'0.0000'),(20,0,'0.0000'),(21,0,'0.0000'),(22,0,'0.0000'),(23,0,'0.0000');

DROP TABLE IF EXISTS {$this->getTable('xreports_dayofweek')};
CREATE TABLE {$this->getTable('xreports_dayofweek')} (
  `d` varchar(50),
  `total_item_count` smallint(5),
  `grand_total` decimal(12,4),
  `n` int(11)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
INSERT INTO {$this->getTable('xreports_dayofweek')} (d, total_item_count, grand_total, n) VALUES('Sunday',0,'0.0000',1),('Monday',0,'0.0000',2),('Tuesday',0,'0.0000',3),('Wednesday',0,'0.0000',4),('Thursday',0,'0.0000',5),('Friday',0,'0.0000',6),('Saturday',0,'0.0000',7);

DROP TABLE IF EXISTS {$this->getTable('xreports_newandreturning')};
CREATE TABLE {$this->getTable('xreports_newandreturning')} (
  `period` varchar(50),
  `new_customers` int(11),
  `returning_customers` int(11),
  `percent_of_new` varchar(50),
  `percent_of_returning` varchar(50),
  `n` int(11)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS {$this->getTable('xreports_salesreport')};
CREATE TABLE {$this->getTable('xreports_salesreport')} (
  `field_1` varchar(50),
  `field_2` varchar(50),
  `field_3` varchar(50),
  `field_4` varchar(50),
  `field_5` varchar(50),
  `field_6` varchar(50),
  `field_7` varchar(50),
  `field_8` varchar(50),
  `field_9` varchar(50),
  `field_10` varchar(50),
  `field_11` varchar(50),
  `field_12` int(11),
  `field_13` int(11),
  `field_14` int(11),
  `field_15` int(11),
  `field_16` decimal(12,4),
  `field_17` decimal(12,4),
  `field_18` decimal(12,4),
  `field_19` decimal(12,4),
  `field_20` decimal(12,4),
  `field_21` decimal(12,4)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    ");

$installer->endSetup();
