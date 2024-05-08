import React, {useState, useEffect, useRef} from 'react'
import { toast } from "sonner"
import { FcApproval, FcHighPriority, FcClock  } from "react-icons/fc";

// type FileUploaderProps = {
//   file: File;
// }
type UploadedFileProps = {
  id: number,
  name: string,
  status: string,
  path: string,
  createdAt: string
}
const FileUploader = () => {

  const [file, setFile] = useState<File | undefined>(undefined);
  const [uploadedFiles, setUploadedFiles] = useState<UploadedFileProps[]>([]);

  const ref = useRef();

  const handleSendFile = () => {
    console.log('Sending file...');
    if (!file) {
      return;
    }
    const formData = new FormData();
    formData.append('file', file);
    fetch('http://localhost:3000/api/charge-batch-file', {
      method: 'POST',
      body: formData,
    })
      .then((response) => response.json())
      .then((result) => {
        console.log(result)
        toast.success("Arquivo enviado com sucesso.")
        if (ref.current) {
          // @ts-ignore
          ref.current.value = ""
        }
        setFile(undefined)
        fetchUploadedFiles()
      })
      .catch((error) => {
        console.log(error)
        toast.error("Erro ao enviar o arquivo.")
      });
  }

  const fetchUploadedFiles = () => {
    fetch('http://localhost:3000/api/charge-batch-file', {
      method: 'GET',
    })
      .then((response) => response.json())
      .then((result) => {
        setUploadedFiles(result)
      })
      .catch((error) => {
        console.log(error)
        toast.error("Erro ao buscar os arquivos.")
      });
  }

  useEffect(() => {
    fetchUploadedFiles()
  }, [])

  return (
    <div className = "flex flex-col gap-6">
      <div>
        <label htmlFor="file" className="sr-only">
          Escolha o arquivo
        </label>
        <input
          id="file"
          type="file"
          ref={ref}
          className={'relative m-0 block w-full min-w-0 flex-auto rounded border border-solid border-neutral-300 bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-neutral-200 focus:border-primary focus:text-neutral-700 focus:shadow-te-primary focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:file:bg-neutral-700 dark:file:text-neutral-100 dark:focus:border-primary'}
          accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel,text/csv"
          onChange={(e) => {
            const file = e.target.files?.[0];
            setFile(file)
            if (file) {
              console.log(file);
            }
          }}
        />
      </div>
      {file && (
        <React.Fragment>
          <section>
            <p className="pb-6">Detalhes do arquivo:</p>
            <ul>
              <li>Nome: {file.name}</li>
              <li>MimeType: {file.type}</li>
              <li>Tamanho: {file.size} bytes</li>
            </ul>
          </section>
          <button
            onClick={handleSendFile}
            className="rounded-lg bg-green-800 text-white px-4 py-2 border-none font-semibold"
          >
            Enviar arquivo
          </button>

        </React.Fragment>
      )}
      {uploadedFiles.length > 0 && (
        <div className="relative overflow-x-auto" style={{maxHeight: '300px'}}>
          <table className="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead className="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" className="px-6 py-3"> </th>
              <th scope="col" className="px-6 py-3">
                #
              </th>
              <th scope="col" className="px-6 py-3">
                Nome
              </th>
              <th scope="col" className="px-6 py-3">
                Data
              </th>
            </tr>
            </thead>
            <tbody>
            {uploadedFiles.map((f) => (
              <tr className="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td className="px-6 py-4">
                  {f.status === 'PROCESSED' && <FcApproval title={'Sucesso'} />}
                  {f.status === 'FAILED' && <FcHighPriority title={'Falha'} />}
                  {f.status === 'PENDING' && <FcClock title={'Pendente'} />}
                </td>
                <th scope="row" className="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                  {f.id}
                </th>
                <td className="px-6 py-4">
                  {f.name}
                </td>
                <td className="px-6 py-4">
                  {f.createdAt}
                </td>
              </tr>
            ))}
            </tbody>
          </table>
        </div>
      )}

    </div>
  );
};

export {FileUploader};
