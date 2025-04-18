import { Dialog, DialogContent, DialogHeader, DialogTitle, DialogFooter } from '@/components/ui/dialog';
import { Button } from '@/components/ui/button';
import { Label } from '@/components/ui/label';
import { Input } from '@/components/ui/input';
import { Textarea } from '@/components/ui/textarea';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { useForm } from '@inertiajs/react';
import { AlertCircle, Loader2, Save, X, CheckCircle, XCircle } from 'lucide-react';
import { useState } from 'react';

interface WardCreateDialogProps {
  isOpen: boolean;
  onClose: () => void;
}

export function WardCreateDialog({ isOpen, onClose }: WardCreateDialogProps) {
  const [formSubmitted, setFormSubmitted] = useState(false);
  
  const form = useForm<{
    ward_name: string;
    ward_description: string;
    ward_capacity: number;
    ward_status: boolean;
  }>({
    ward_name: '',
    ward_description: '',
    ward_capacity: 0,
    ward_status: true,
  });

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    setFormSubmitted(true);
    form.post(route('wards.store'), {
      onSuccess: () => {
        onClose();
        form.reset();
        setFormSubmitted(false);
      },
      onError: () => {
        setFormSubmitted(false);
      }
    });
  };

  return (
    <Dialog open={isOpen} onOpenChange={(open) => {
      if (!open) onClose();
    }}>
      <DialogContent className="sm:max-w-md rounded-lg p-0 overflow-hidden">
        <DialogHeader className="text-black dark:text-white p-4">
          <DialogTitle className="text-xl font-medium flex items-center gap-2">
            <CheckCircle className="h-5 w-5" />
            Create New Ward
          </DialogTitle>
        </DialogHeader>

        <form onSubmit={handleSubmit} className="space-y-4 p-6">
          {/* Name */}
          <div className="grid gap-2">
            <Label htmlFor="ward_name" className="text-sm font-medium text-gray-700">
              Ward Name
            </Label>
            <Input
              id="ward_name"
              value={form.data.ward_name}
              onChange={(e) => form.setData('ward_name', e.target.value)}
              placeholder="Enter ward name"
              className="rounded-md focus:border-blue-500 focus:ring-blue-500"
            />
            {form.errors.ward_name && (
              <p className="text-sm text-red-500 flex items-center gap-1 mt-1">
                <AlertCircle className="h-3 w-3" />
                {form.errors.ward_name}
              </p>
            )}
          </div>

          {/* Description */}
          <div className="grid gap-2">
            <Label htmlFor="ward_description" className="text-sm font-medium text-gray-700">
              Description
            </Label>
            <Textarea
              id="ward_description"
              value={form.data.ward_description}
              onChange={(e) => form.setData('ward_description', e.target.value)}
              placeholder="Enter ward description"
              rows={3}
              className="rounded-md focus:border-blue-500 focus:ring-blue-500"
            />
            {form.errors.ward_description && (
              <p className="text-sm text-red-500 flex items-center gap-1 mt-1">
                <AlertCircle className="h-3 w-3" />
                {form.errors.ward_description}
              </p>
            )}
          </div>

          {/* Capacity */}
          <div className="grid gap-2">
            <Label htmlFor="ward_capacity" className="text-sm font-medium text-gray-700">
              Capacity
            </Label>
            <Input
              id="ward_capacity"
              type="number"
              value={form.data.ward_capacity}
              onChange={(e) => form.setData('ward_capacity', parseInt(e.target.value) || 0)}
              placeholder="Enter capacity"
              className="rounded-md focus:border-blue-500 focus:ring-blue-500"
              min="0"
            />
            {form.errors.ward_capacity && (
              <p className="text-sm text-red-500 flex items-center gap-1 mt-1">
                <AlertCircle className="h-3 w-3" />
                {form.errors.ward_capacity}
              </p>
            )}
          </div>

          {/* Status */}
          <div className="grid gap-2">
            <Label htmlFor="ward_status" className="text-sm font-medium text-gray-700">
              Status
            </Label>
            <Select
              value={form.data.ward_status ? 'active' : 'inactive'}
              onValueChange={(value) => form.setData('ward_status', value === 'active')}
            >
              <SelectTrigger className="rounded-md focus:border-blue-500 focus:ring-blue-500">
                <SelectValue placeholder="Select status" />
              </SelectTrigger>
              <SelectContent>
                <SelectItem value="active" className="flex items-center gap-2">
                  <div className="flex items-center gap-2">
                    <CheckCircle className="h-4 w-4 text-green-600" />
                    <span>Active</span>
                  </div>
                </SelectItem>
                <SelectItem value="inactive" className="flex items-center gap-2">
                  <div className="flex items-center gap-2">
                    <XCircle className="h-4 w-4 text-red-600" />
                    <span>Inactive</span>
                  </div>
                </SelectItem>
              </SelectContent>
            </Select>
            {form.errors.ward_status && (
              <p className="text-sm text-red-500 flex items-center gap-1 mt-1">
                <AlertCircle className="h-3 w-3" />
                {form.errors.ward_status}
              </p>
            )}
          </div>

          {/* Buttons */}
          <DialogFooter className="mt-6">
            <Button 
              type="button" 
              variant="outline" 
              onClick={onClose} 
              className="text-gray-700 hover:bg-gray-50 flex items-center gap-2"
            >
              <X className="h-4 w-4" />
              Cancel
            </Button>
            <Button 
              type="submit" 
              disabled={form.processing || formSubmitted}
              className=" hover:from-blue-700 hover:to-indigo-700 text-white flex items-center gap-2"
            >
              {form.processing || formSubmitted ? (
                <>
                  <Loader2 className="h-4 w-4 animate-spin" />
                  Creating...
                </>
              ) : (
                <>
                  <Save className="h-4 w-4" />
                  Create Ward
                </>
              )}
            </Button>
          </DialogFooter>
        </form>
      </DialogContent>
    </Dialog>
  );
}