ALTER TABLE "#__patchtester_pulls" ADD COLUMN "is_npm" smallint DEFAULT 1  NOT NULL;

CREATE TABLE IF NOT EXISTS "#__patchtester_pulls_labels"
(
    "id"      serial                 NOT NULL,
    "pull_id" bigint                 NOT NULL,
    "name"    character varying(200) NOT NULL,
    "color"   character varying(6)   NOT NULL,
    PRIMARY KEY ("id")
);
