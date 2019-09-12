CREATE TABLE IF NOT EXISTS "#__patchtester_chain" (
  "id" serial NOT NULL,
  "insert_id" bigint NOT NULL,
  "pull_id" bigint NOT NULL,
  PRIMARY KEY (`id`)
);
