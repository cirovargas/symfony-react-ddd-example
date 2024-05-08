import { ReactElement } from "react";
import {FileUploader, Toaster} from "@/components";


function NoMatch(): ReactElement {
    return (
        <div className="h-screen w-screen bg-zinc-800 text-white gap-6 flex flex-1 flex-col items-center justify-center">
            <h2 className="text-2xl font-medium">Upload de arquivos de lote</h2>
            <FileUploader />
            <Toaster />
        </div>
    );
}

export { NoMatch }
