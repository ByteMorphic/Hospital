import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, router, useForm } from '@inertiajs/react';
import { ColumnHeader } from '@/components/table/column-header';
import DataTable from '@/components/table/data-table';
import { useMemo, useState } from 'react';
import { ColumnDef } from '@tanstack/react-table';
import { Button } from '@/components/ui/button';
import { WardCreateDialog } from './GenericCreateDialog';
import { WardEditDialog } from './GenericEditDialog';
import { Badge } from '@/components/ui/badge';
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuItem,
  DropdownMenuTrigger
} from '@/components/ui/dropdown-menu';
import {
  MoreHorizontal,
  Search,
  PlusCircle,
  Edit2,
  Trash2,
  CheckCircle,
  XCircle
} from 'lucide-react';
import { Input } from '@/components/ui/input';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Generics',
    href: '/generics',
  },
];

export interface Generic {
  id: number;
  generic_name: string;
  generic_description: string;
  therapeutic_class: string;
  generic_category: string;
  generic_subcategory: string;
  generic_notes: string;
  generics_status: boolean;
}

export default function Generic({ generics, filters }: { generics: any; filters: { q?: string } }) {

  console.log(generics)

  const [isCreateDialogOpen, setIsCreateDialogOpen] = useState(false);
  const [isEditDialogOpen, setIsEditDialogOpen] = useState(false);
  const [selectedGeneric, setSelectedGeneric] = useState<Generic | null>(null);
  const [search, setSearch] = useState(filters.q || '');

  const handleStatusChange = (generic: Generic, newStatus: boolean) => {
    router.put(route('generics.status'), {
      generic_id: generic.id,
      status: newStatus ? 'active' : 'block',
    });
  };

  const handleSearchSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    router.get(route('generics.index'), { q: search }, { preserveState: true });
  };

  const columns = useMemo<ColumnDef<Generic>[]>(() => [
    {
      id: 'generic_name',
      accessorKey: 'generic_name',
      header: ({ column }) => <ColumnHeader column={column} title="Name" />,
      cell: ({ row }) => {
        const generic = row.original;
        return (
          <div className="font-medium">{generic.generic_name}</div>
        );
      }
    },
    {
      id: 'generic_description',
      accessorKey: 'generic_description',
      enableSorting: false,
      header: ({ column }) => <ColumnHeader column={column} title="Description" />,
      cell: ({ row }) => {
        const generic = row.original;
        return (
          <div
            className="text-sm text-gray-500 max-w-md"
            aria-label="ward_description"
            aria-description={generic.generic_description}
          >
            {
              generic.generic_description && generic.generic_description.length > 20
                ? generic.generic_description.slice(0, 20) + '...'
                : generic.generic_description
            }
          </div>
        );
      },
    },
    {
      id: 'therapeutic_class',
      accessorKey: 'therapeutic_class',
      header: ({ column }) => <ColumnHeader column={column} title="Therapeutic Class" />,
      cell: ({ row }) => {
        const generic = row.original;
        return (
          <div className="text-center">
            <Badge variant="outline" className="bg-blue-50 text-blue-700 hover:bg-blue-100">
              {generic.therapeutic_class}
            </Badge>
          </div>
        );
      },
    },
    {
      id: 'generics_status',
      accessorKey: 'generics_status',
      header: ({ column }) => <ColumnHeader column={column} title="Status" />,
      cell: ({ row }) => {
        const generic = row.original;
        return (
          <DropdownMenu>
            <DropdownMenuTrigger asChild>
              <Button
                variant="ghost"
                className={`flex items-center gap-2 ${generic.generics_status ? 'text-green-600 hover:text-green-700' : 'text-red-600 hover:text-red-700'}`}
              >
                {generic.generics_status ? (
                  <><CheckCircle className="h-4 w-4" /> Active</>
                ) : (
                  <><XCircle className="h-4 w-4" /> Inactive</>
                )}
              </Button>
            </DropdownMenuTrigger>
            <DropdownMenuContent align="end" className="w-32">
              <DropdownMenuItem
                onClick={() => handleStatusChange(generic, true)}
                className="flex items-center gap-2"
              >
                <CheckCircle className="h-4 w-4 text-green-600" /> Active
              </DropdownMenuItem>
              <DropdownMenuItem
                onClick={() => handleStatusChange(generic, false)}
                className="flex items-center gap-2"
              >
                <XCircle className="h-4 w-4 text-red-600" /> Inactive
              </DropdownMenuItem>
            </DropdownMenuContent>
          </DropdownMenu>
        );
      },
    },
    {
      id: 'action',
      header: ({ column }) => <ColumnHeader column={column} title="Action" />,
      cell: ({ row }) => {
        const generic = row.original;
        return (
          <DropdownMenu>
            <DropdownMenuTrigger asChild>
              <Button variant="ghost" className="h-8 w-8 p-0">
                <span className="sr-only">Open menu</span>
                <MoreHorizontal className="h-4 w-4" />
              </Button>
            </DropdownMenuTrigger>
            <DropdownMenuContent align="end" className="w-36">
              <DropdownMenuItem
                onClick={() => {
                  setSelectedGeneric(generic);
                  setIsEditDialogOpen(true);
                }}
                className="flex items-center gap-2"
              >
                <Edit2 className="h-4 w-4 text-blue-600" /> Edit
              </DropdownMenuItem>
              <DropdownMenuItem
                className="flex items-center gap-2 text-red-600 hover:text-red-700 focus:text-red-700"
                onClick={() => {
                  if (confirm('Are you sure you want to delete this ward?')) {
                    router.delete(route('wards.destroy', generic.id), {
                      preserveState: true,
                      onSuccess: () => {
                        console.log('deleted');
                      },
                    });
                  }
                }}
              >
                <Trash2 className="h-4 w-4" /> Delete
              </DropdownMenuItem>
            </DropdownMenuContent>
          </DropdownMenu>
        );
      },
    },
  ], []);

  return (
    <AppLayout breadcrumbs={breadcrumbs}>
      <Head title="Generics" />
      <div className="flex h-full flex-1 flex-col gap-4 p-6">
        <Card className="border-0 shadow-md">
          <CardHeader className=" text-white rounded-t-lg">
            <CardTitle className="text-xl font-medium">Generics Management</CardTitle>
          </CardHeader>
          <CardContent className="p-6">
            {/* Search and Actions */}
            <div className="flex items-center justify-between mb-6">
              <form onSubmit={handleSearchSubmit} className="relative w-full max-w-sm">
                <Search className="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-500" />
                <Input
                  placeholder="Search Generics..."
                  value={search}
                  onChange={(e) => setSearch(e.target.value)}
                  className="pl-10 pr-4 py-2 focus:border-blue-500 focus:ring-blue-500 rounded-md"
                />
              </form>
              <Button
                className="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white shadow-sm flex items-center gap-2"
                onClick={() => setIsCreateDialogOpen(true)}
              >
                <PlusCircle className="h-4 w-4" />
                Create New
              </Button>
            </div>

            {/* Table */}
            <div className="rounded-lg overflow-hidden shadow-sm">
              <DataTable
                columns={columns}
                data={generics.data}
                pagination={generics.meta}
              />
            </div>
          </CardContent>
        </Card>
      </div>

      {/* Create Dialog */}
      <WardCreateDialog isOpen={isCreateDialogOpen} onClose={() => setIsCreateDialogOpen(false)} />

      {/* Edit Dialog */}
      {/* {selectedGeneric && (
        <WardEditDialog
          isOpen={isEditDialogOpen}
          onClose={() => setIsEditDialogOpen(false)}
          generic={selectedGeneric}
        />
      )} */}
    </AppLayout>
  );
}