type PageWrapperProps = {
  children: React.ReactNode;
  background?: "white" | "bg-gray-50" | "bg-red-100";
};

export default function PageWrapper({
  children,
  background = "white",
}: PageWrapperProps) {
  return (
    <div className={`${background}`}>
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">
        {children}
      </div>
    </div>
  );
}
