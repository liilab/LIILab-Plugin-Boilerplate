import React from "react";
import "./AdminNotice.scss";

export default function AdminNotice() {
  const [copied, setCopied] = React.useState(false);
  const shortcode = "[liilab_current_user_info id='1']";
  return (
    <>
      <a
        href="#"
        className="block-style"
      >
        <h5 className="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
          LIILab Plugin Boilerplate
        </h5>
        <p className="font-normal text-gray-700 dark:text-gray-400">
         Copy this shortcode and paste it into your page or post.
        </p>
        <div className="flex items-center justify-between mt-4">
        <span
            style={{
              cursor: "pointer",
              backgroundColor: "#dcdcde",
              padding: "8px 10px",
              borderRadius: "2px",
              transition: "opacity 0.3s",
              opacity: copied ? 0.5 : 1,
            }}
            onClick={(e: any) => {
              e.preventDefault();
              const valueToCopy = String(shortcode);
              navigator.clipboard.writeText(valueToCopy);
              setCopied(true);

              // Reset the copied state after a delay
              setTimeout(() => {
                setCopied(false);
              }, 5000);
            }}
          >
            {shortcode}
          </span>
          </div>
      </a>
    </>
  );
}
