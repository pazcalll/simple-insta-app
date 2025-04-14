import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";

export default function Page() {
  return (
    <div className="flex items-center justify-center min-h-screen p-8 pb-20 gap-16 sm:p-20 font-[family-name:var(--font-geist-sans)]">
      <form className="flex flex-col gap-4 w-full max-w-sm">
        <h1 className="text-3xl font-semibold">Login</h1>
        <Input type="email" placeholder="Email" />
        <Input type="password" placeholder="Password" />
        <Button>Login</Button>
        <p className="text-sm text-gray-500">
          Don`t have an account? click{" "}
          <Button variant={"link"} className="p-0 cursor-pointer">
            here
          </Button>
        </p>
      </form>
    </div>
  );
}
