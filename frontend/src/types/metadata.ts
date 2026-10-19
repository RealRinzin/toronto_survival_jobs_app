interface metaDataDType {
  params: Promise<{ slug: string }>; 
  searchParams: Promise<{ [key: string]: string | string[] | undefined }>;
};
