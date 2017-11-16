CREATE TABLE "public"."Authors" (
"id" serial NOT NULL,
"name" varchar(32) NOT NULL
);
ALTER TABLE "public"."Authors" ADD PRIMARY KEY ("id");

CREATE TABLE "public"."Languages" (
"id" serial NOT NULL,
"name" varchar(16) NOT NULL
);
ALTER TABLE "public"."Languages" ADD PRIMARY KEY ("id");


CREATE TABLE "public"."Posts" (
"id" serial NOT NULL,
"language" int4 NOT NULL,
"author" int4 NOT NULL,
"date" date DEFAULT now(),
"title" varchar(64) NOT NULL,
"content" text,
"likes" int4 DEFAULT 0,
CONSTRAINT "Posts_pkey" PRIMARY KEY ("id")
);

ALTER TABLE "public"."Posts" ADD PRIMARY KEY ("id");
ALTER TABLE "public"."Posts" ADD CONSTRAINT "Posts_author_fkey" FOREIGN KEY ("author") REFERENCES "public"."Authors" ("id") ON DELETE CASCADE ON UPDATE NO ACTION;
ALTER TABLE "public"."Posts" ADD CONSTRAINT "Posts_language_fkey" FOREIGN KEY ("language") REFERENCES "public"."Languages" ("id") ON DELETE CASCADE ON UPDATE NO ACTION;


INSERT INTO "public"."Authors" ("name") VALUES('CatFuns'),('CarDriver'),('BestPics'),('ЗОЖ'),('Вася Пупкин'),('Готовим со вкусом'),('Шахтёрская Правда'),('FunScience');
INSERT INTO "public"."Languages" ("name") VALUES('Русский'),('English');
