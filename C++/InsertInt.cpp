#include "DataL8.h"

void insert(MTREE* tree, int input)
{
	if (!tree->root)
	{
		//printf("Root is Null ");
		tree->root = (NODE*)malloc(sizeof(NODE));
		tree->root->firstPtr = NULL;
		tree->root->entries[0].data = input;
		tree->root->entries[0].rightPtr = NULL;
		tree->root->numEntries = 1;
		tree->count = 1;
		return;
	}
	NODE** n = (NODE**)malloc(sizeof(NODE*));
		n = &tree->root;
	while (true)
	{
		if (!*n)
		{
			//printf("N is null ");
			*n = (NODE*)malloc(sizeof(NODE));
			(*n)->firstPtr = NULL;
			(*n)->entries[0].data = input;
			(*n)->entries[0].rightPtr = NULL;
			(*n)->numEntries = 1;
			return;
		}
		else if ((*n)->numEntries < Mul - 1)
		{
			//printf("N is not full. ");
			for (int i = 0; i < (*n)->numEntries; i++)
			{
				if (input < (*n)->entries[i].data)
				{
					
					for (int j = (*n)->numEntries - 1; j >= i; j--)
					{
						//printf("\ni = %d, j = %d ", i, j);
						(*n)->entries[j + 1] = (*n)->entries[j];
					}
					(*n)->entries[i].data = input;
					(*n)->entries[i].rightPtr = NULL;
					(*n)->numEntries++;
					return;
				}
			}
			(*n)->entries[(*n)->numEntries].data = input;
			(*n)->entries[(*n)->numEntries].rightPtr = NULL;
			(*n)->numEntries++;
			return;
			
		}
		else //node is full
		{
			//printf("N is full. ");
			if (input < (*n)->entries[0].data)
			{
				//printf("[0] ");
				n = &((*n)->firstPtr);
			}
			else
			for (int i = (*n)->numEntries-1; i >= 0; i--)
			{
				if (input >= (*n)->entries[i].data)
				{
					//printf("[%d] ", i+1);
					n = &(*n)->entries[i].rightPtr;
					break;
				}
			}
		}
	}
}