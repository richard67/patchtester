CREATE TABLE [#__patchtester_chain] (
  [id] [bigint] IDENTITY(1,1) NOT NULL,
  [insert_id] [bigint] NOT NULL,
  [pull_id] [bigint] NOT NULL,
  CONSTRAINT [PK_#__patchtester_chain] PRIMARY KEY CLUSTERED
(
  [id] ASC
) WITH (STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF)
);
