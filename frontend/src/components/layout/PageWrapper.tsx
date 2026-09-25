type PageWrapperProps = {
  children: React.ReactNode;
  maxWidth?: "sm" | "md" | "lg" | "xl" | "7xl";
  background?: "white" | "gray" | "navy";
  padding?: boolean;
};

const maxWidthMap: Record<NonNullable<PageWrapperProps["maxWidth"]>, string> = {
  sm: "max-w-screen-sm",
  md: "max-w-screen-md",
  lg: "max-w-screen-lg",
  xl: "max-w-screen-xl",
  "7xl": "max-w-7xl",
};
const backgroundMap: Record<NonNullable<PageWrapperProps['background']>, string> = {
  white: 'bg-white',
  gray: 'bg-gray-50',
  navy: 'bg-navy-900 text-white',
}
export default function PageWrapper({
  children,
  maxWidth = "lg",
}: PageWrapperProps) {
  return (
    <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8">
      {children}
    </div>
  );
}
