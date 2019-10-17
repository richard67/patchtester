CREATE TABLE [#__patchtester_pulls] (
  [id] [bigint] IDENTITY(1,1) NOT NULL,
  [pull_id] [bigint] NOT NULL,
  [title] [nvarchar](200) NOT NULL,
  [description] [nvarchar](150) NOT NULL DEFAULT '',
  [pull_url] [nvarchar](255) NOT NULL,
  [sha] [nvarchar](40) NOT NULL DEFAULT '',
  [is_rtc] [smallint] NOT NULL DEFAULT 1,
  [branch] [nvarchar](255) NOT NULL DEFAULT '',
 CONSTRAINT [PK_#__patchtester_pulls] PRIMARY KEY CLUSTERED
(
  [id] ASC
) WITH (STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF)
);

CREATE TABLE [#__patchtester_tests](
  [id] [bigint] IDENTITY(1,1) NOT NULL,
  [pull_id] [bigint] NOT NULL,
  [data] [nvarchar](MAX) NULL,
  [patched_by] [bigint] NOT NULL,
  [applied] [bigint] NOT NULL,
  [applied_version] [nvarchar](25) NOT NULL,
 CONSTRAINT [PK_#__patchtester_tests] PRIMARY KEY CLUSTERED
(
  [id] ASC
) WITH (STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF)
);

CREATE TABLE [#__patchtester_chain] (
  [id] [bigint] IDENTITY(1,1) NOT NULL,
  [insert_id] [bigint] NOT NULL,
  [pull_id] [bigint] NOT NULL,
  CONSTRAINT [PK_#__patchtester_chain] PRIMARY KEY CLUSTERED
(
  [id] ASC
) WITH (STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF)
);
