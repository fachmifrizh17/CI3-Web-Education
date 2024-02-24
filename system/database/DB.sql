
CREATE TABLE "public"."prct_request" ("nomor" varchar(15) NOT NULL DEFAULT 'nomor',"tanggal" timestamp NOT NULL,"tglestimasi" timestamp NOT NULL,"keterangan" varchar NOT NULL,"batal" bool,"tglbatal" timestamp,"userbatal" varchar,"keteranganbatal" varchar,"approve" bool,"userapprove" bool,"tglapprove" bool,"kodejenis" varchar,"kodegrup" varchar,"kodekategori" varchar,"kodesubkategori" varchar,"tglsimpan" timestamp,"pemakai" varchar,"kode_cabang" varchar(3));
CREATE TABLE "public"."prct_requestdetail" ("nomor_request" varchar(15) NOT NULL,"kode_barang" varchar(15),"qty" numeric,"keterangan" varchar,"tglsimpan" timestamp,"pemakai" varchar);
CREATE TABLE "public"."prct_pilihvendor" ("tanggal" timestamp NOT NULL,"nomor_supplier" varchar NOT NULL,"noreferensi" varchar NOT NULL,"tglsimpan" timestamp NOT NULL,"pemakai" varchar NOT NULL,"kode_cabang" varchar);
CREATE TABLE "public"."prct_quotation" ("nomor" varchar NOT NULL DEFAULT 'nomor',"tanggal" timestamp,"nomor_vendor" varchar,"nomor_request" varchar,"harga" numeric,"persendisc" numeric,"discount" numeric,"subtotal" numeric,"dpp" numeric,"ppn" numeric,"grandtotal" numeric,"dokumen" text,"approve" bool,"userapprove" varchar,"tglapprove" timestamp,"batal" bool,"userbatal" varchar,"tglbatal" timestamp,"keteranganbatal" varchar,"tglsimpan" timestamp,"pemakai" varchar,"kode_cabang" varchar);
CREATE TABLE "public"."prct_quotationdetail" ("nomor_quotation" varchar NOT NULL DEFAULT 'nomor_quotation', danger KEY ("nomor_quotation"));

ALTER TABLE "public"."prct_quotationdetail"
ADD COLUMN "kode_barang" varchar NOT NULL,
ADD COLUMN "qty" numeric NOT NULL,
ADD COLUMN "harga" numeric NOT NULL,
ADD COLUMN "persendiscperitem" numeric NOT NULL,
ADD COLUMN "discountperitem" numeric NOT NULL,
ADD COLUMN "subtotal" numeric NOT NULL;

ALTER TABLE "public"."prct_purchaseorder"
ADD COLUMN "tanggal" timestamp,
ADD COLUMN "nomor_quotation" varchar,
ADD COLUMN "nomor_vendor" varchar,
ADD COLUMN "status" numeric,
ADD COLUMN "keterangan" varchar,
ADD COLUMN "totalharga" numeric,
ADD COLUMN "persendisc" numeric,
ADD COLUMN "discount" numeric,
ADD COLUMN "dpp" numeric,
ADD COLUMN "ppn" numeric,
ADD COLUMN "subtotal" numeric,
ADD COLUMN "grandtotal" numeric,
ADD COLUMN "batal" bool,
ADD COLUMN "userbatal" varchar,
ADD COLUMN "tglbatal" timestamp,
ADD COLUMN "keteranganbatal" varchar,
ADD COLUMN "tglsimpan" timestamp,
ADD COLUMN "pemakai" varchar,
ADD COLUMN "kode_cabang" varchar;

ALTER TABLE "public"."prct_purchaseorderdetail"
ADD COLUMN "kode_barang" varchar,
ADD COLUMN "qty" numeric,
ADD COLUMN "harga" numeric,
ADD COLUMN "persendiscperitem" numeric,
ADD COLUMN "discountperitem" numeric,
ADD COLUMN "subtotal" numeric;

ALTER TABLE "public"."prct_goodreceipt"
ADD COLUMN "tanggal" timestamp,
ADD COLUMN "nomor_po" varchar,
ADD COLUMN "nomor_vendor" varchar,
ADD COLUMN "penerima" varchar,
ADD COLUMN "keterangan" varchar,
ADD COLUMN "penilaian" varchar,
ADD COLUMN "invoice" bool,
ADD COLUMN "noinvoice" varchar,
ADD COLUMN "tglinvoice" timestamp,
ADD COLUMN "userinvoice" varchar,
ADD COLUMN "nofakturpajak" varchar,
ADD COLUMN "pemakai" varchar,
ADD COLUMN "tglsimpan" timestamp,
ADD COLUMN "kode_cabang" varchar;